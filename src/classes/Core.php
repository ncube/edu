<?php
class Core {
    public $page_name;
    
    function __construct($page_name) {
        $this->page_name = $page_name;
    }

    function loadCss($libs) {
        $name = $this->page_name;

        $ex_libs = isset($GLOBALS['routes'][$name]['includes']['css']) ? $GLOBALS['routes'][$name]['includes']['css'] : FALSE;
        $libs = empty($ex_libs) ? $libs : array_merge($libs, $ex_libs);
        $code = NULL;

        $css = $GLOBALS['config']['css'];
        foreach ($libs as $value) {
            if(gettype($css[$value]) === 'string') {
                $code .= '<link rel="stylesheet" type="text/css" href="/public/'.$css[$value].'">';
            } else {
                foreach ($css[$value] as $value2) {
                    $code .= '<link rel="stylesheet" type="text/css" href="/public/'.$css[$value2].'">';
                }
            }
        }
        return $code;
    }

    function loadJsBottom($libs) {
        $name = $this->page_name;
        $ex_libs = isset($GLOBALS['routes'][$name]['includes']['js']['bottom']) ? $GLOBALS['routes'][$name]['includes']['js']['bottom'] : NULL;
        $libs = empty($ex_libs) ? $libs : array_merge($libs, $ex_libs);
        $js = $GLOBALS['config']['js'];
        $code = NULL;
        foreach ($libs as $value) {
            if(gettype($js[$value]) === 'string') {
                if (substr($value, 0, 3) === 'ng-') {
                    $code .= '<script type="text/javascript" ng-src="/public/'.$js[$value].'"></script>';
                } else {
                    $code .= '<script type="text/javascript" src="/public/'.$js[$value].'"></script>';
                }
            } else {
                foreach ($js[$value] as $value2) {
                    if (substr($value2, 0, 3) === 'ng-') {
                        $code .= '<script type="text/javascript" ng-src="/public/'.$js[$value2].'"></script>';
                    } else {
                        $code .= '<script type="text/javascript" src="/public/'.$js[$value2].'"></script>';
                    }
                }
            }
        }
        return $code;
    }

    function loadJsTop($libs) {
        $name = $this->page_name;
        $ex_libs = $GLOBALS['routes'][$name]['includes']['js']['top'];
        $libs = empty($ex_libs) ? $libs : array_merge($libs, $ex_libs);
        $js = $GLOBALS['config']['js'];
        foreach ($libs as $value) {
            if(gettype($js[$value]) === 'string') {
                if (substr($value, 0, 3) === 'ng-') {
                    $code .= '<script type="text/javascript" ng-src="/public/'.$js[$value].'"></script>';
                } else {
                    $code .= '<script type="text/javascript" src="/public/'.$js[$value].'"></script>';
                }
            } else {
                foreach ($js[$value] as $value2) {
                    if (substr($value2, 0, 3) === 'ng-') {
                        $code .= '<script type="text/javascript" ng-src="/public/'.$js[$value2].'"></script>';
                    } else {
                        $code .= '<script type="text/javascript" src="/public/'.$js[$value2].'"></script>';
                    }
                }
            }
        }
        return $code;
    }

    function loadContent($name, $data = NULL, $url = NULL) {
        $type = $name[0].$name[strlen($name)-1];
        if ($type === '--') {
            $content = $GLOBALS['routes'][$this->page_name]['content'][$name];
            if (gettype($content) === 'array') {
                $content_data = isset($content[1]['data']) ? $content[1]['data'] : [];
                foreach($content_data as $value) {
                    require_once 'models/'.$value.'.php';
                }
                $content = $content[0];
            }
            require_once 'views/'.$content;
        } else {
            $content = $GLOBALS['content'][$name];
            if (gettype($content) === 'array') {
                $data = $content[1]['data'];
                foreach($data as $value) {
                    require_once 'models/'.$value.'.php';
                }
                $content = $content[0];
            }
            require_once 'views/'.$content;
        }
    }

    function loadView($name, $data = NULL) {
        $page = $GLOBALS['url_array'][0];
        $args = $GLOBALS['url_array'];
        $key = explode('-', $name)[1];
        $args[$key] = isset($args[$key]) ? $args[$key] : 'index';
        unset($args[0]);
        if(!empty($args)) {
            require_once "views/include/$page/".$args[explode('-', $name)[1]].'.php'; 
        } elseif(file_exists("views/include/$page/index.php")) {
            require_once "views/include/$page/index.php";
        }
    }
    
    function serve() {
        $name = $this->page_name;
        $page = $GLOBALS['routes'][$name];

        if(isset($page['redirect'])) {
            Redirect::to($page['redirect']);
        }

        if(isset($page['parent']) && $page['parent'] === TRUE) {
            $url = Utils::parseUrl($name);

            array_pop($url);
            $name = '';

            foreach($url as $value) {
                $name = $name.$value.'/';
            }

            $name = trim($name, '/');

            $this->page_name = $name;
            $page = $GLOBALS['routes'][$name];
        }

        if(!empty($page['template'])) {
            $view = 'templates/'.$page['template'].'.php';
        } elseif (!empty($page['view'])) {
            $view = $page['view'];
        } elseif(!empty($page['function'])) {
            require_once 'views/functions.php';
            Funcs::$page['function']();
            die; 
        } else {
            echo 'View not configured properly.';
            die;
        }

        $var = (isset($page['var'])) ? $page['var'] : NULL;

        $title = $page['title'];
        $url['path'] = Input::get('url');

        if (!empty($page['data'])) {
            foreach($page['data'] as $value) {
                require_once 'models/'.$value.'.php';
            }
        }
        $path = 'views/'.$view;
        require_once $path;
    }
}