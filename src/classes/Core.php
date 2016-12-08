<?php
class Core {
    public $page_name;
    public $url;
    
    function __construct($page_name, $url, $page_url) {
        $this->page_name = $page_name;
        $this->url = $url;
        $this->page = $page_url;
    }

    function loadCss() {
        $name = $this->page_name;
        if($name[0].$name[strlen($name)-1] === '--') {
            $libs = $GLOBALS['views'][explode('-', $name)[1]]['includes']['css'];
        } else {
            $libs = $GLOBALS['pages'][$name]['includes']['css'];
        }
        $css = $GLOBALS['config']['css'];
        foreach ($libs as $value) {
            if(gettype($css[$value]) === 'string') {
                $code .= '<link rel="stylesheet" type="text/css" href="/public/css/'.$css[$value].'">';
            } else {
                foreach ($css[$value] as $value2) {
                    $code .= '<link rel="stylesheet" type="text/css" href="/public/css/'.$css[$value2].'">';
                }
            }
        }
        return $code;
    }

    function loadJsBottom() {
        $name = $this->page_name;
        if($name[0].$name[strlen($name)-1] === '--') {
            $libs = $GLOBALS['views'][explode('-', $name)[1]]['includes']['js']['bottom'];
        } else {
            $libs = $GLOBALS['pages'][$name]['includes']['js']['bottom'];
        }
        $js = $GLOBALS['config']['js'];
        foreach ($libs as $value) {
            if(gettype($js[$value]) === 'string') {
                if (substr($value, 0, 3) === 'ng-') {
                    $code .= '<script type="text/javascript" ng-src="/public/js/'.$js[$value].'"></script>';
                } else {
                    $code .= '<script type="text/javascript" src="/public/js/'.$js[$value].'"></script>';
                }
            } else {
                foreach ($js[$value] as $value2) {
                    if (substr($value2, 0, 3) === 'ng-') {
                        $code .= '<script type="text/javascript" ng-src="/public/js/'.$js[$value2].'"></script>';
                    } else {
                        $code .= '<script type="text/javascript" src="/public/js/'.$js[$value2].'"></script>';
                    }
                }
            }
        }
        return $code;
    }

    function loadJsTop() {
        $name = $this->page_name;
        if($name[0].$name[strlen($name)-1] === '--') {
            $libs = $GLOBALS['views'][explode('-', $name)[1]]['includes']['js']['top'];
        } else {
            $libs = $GLOBALS['pages'][$name]['includes']['js']['top'];
        }
        $js = $GLOBALS['config']['js'];
        foreach ($libs as $value) {
            if(gettype($js[$value]) === 'string') {
                if (substr($value, 0, 3) === 'ng-') {
                    $code .= '<script type="text/javascript" ng-src="/public/js/'.$js[$value].'"></script>';
                } else {
                    $code .= '<script type="text/javascript" src="/public/js/'.$js[$value].'"></script>';
                }
            } else {
                foreach ($js[$value] as $value2) {
                    if (substr($value2, 0, 3) === 'ng-') {
                        $code .= '<script type="text/javascript" ng-src="/public/js/'.$js[$value2].'"></script>';
                    } else {
                        $code .= '<script type="text/javascript" src="/public/js/'.$js[$value2].'"></script>';
                    }
                }
            }
        }
        return $code;
    }

    function loadContent($name, $data = NULL, $url = NULL) {
        $type = $name[0].$name[strlen($name)-1];
        if ($type === '--') {
            $content = $GLOBALS['pages'][$this->page_name]['content'][$name];
            if (gettype($content) === 'array') {
                $content_data = $content[1]['data'];
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

    function loadView($name, $data = NULL, $url = NULL) {
        if(!empty($url['args'])) {
            require_once "views/include/$this->page/".$url['args'][explode('-', $name)[1]].'.php'; 
        } elseif(file_exists("views/include/$this->page/index.php")) {
            require_once "views/include/$this->page/index.php";
        }
    }
    
    function serve() {
        $name = $this->page_name;

        $page = $GLOBALS['pages'][$name];

        if(empty($page)) {
            echo 'Page not configured properly';
            die;
        }

        if(!empty($page['template'])) {
            $view = $page['template'];
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

        $var = $page['var'];

        $title = $page['title'];
        $url['path'] = Input::get('url');
        $url['args'] = $this->url;

        if (!empty($page['data'])) {
            foreach($page['data'] as $value) {
                require_once 'models/'.$value.'.php';
            }
        }
        $path = 'views/'.$view.'.php';
        if ($page['protect'] == TRUE) {
            new Protect;
        }
        require_once $path;
    }
}