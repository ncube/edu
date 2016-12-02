<?php
class Route {
    public $page;
    public $url;
    public $view;

    public function __construct($url) {
        $this->url = $url;
        $this->view = NULL;
        $this->page = '404';

        self::check();
        // TODO: Redirect Feature
    }

    private function check() {
        $routes = $GLOBALS['routes'];
        $url = $this->url;
        $base_url = $url[0];
        // if it exists in routes array
        // Else if it exists in pages
        //  Else page not found
        if (array_key_exists($base_url, $routes)) {
            $route_str = explode('/', rtrim($routes[$base_url], '/'));
            $url_len = count($this->url);
            $route_str_len = count($route_str);
            $route_str = Utils::trim_array($route_str, ',');
            foreach ($route_str as  $key => $value) {
                if($value[0] === '*') {
                    $var_list[] = $key;  
                }
                if (strpos($value, ',')) {
                    $sub_pages[$key] = explode(',', $value);
                }
            }
            $sub_pages_list = array_keys($sub_pages);
            if($url_len > $route_str_len) {
                $this->page = '404';
            } else {    
                if((count($url) === 1) && ($route_str[0] !== $url[0])) {
                    self::checkPage($route_str[0]);
                }
                foreach ($url as $key => $value) {
                    $str = $route_str[$key];
                    if(!($str[0] === '*' || $str === $value) && !(strpos($str,',') && in_array($value,$sub_pages[$key]))) {
                        $error = TRUE;
                        break;
                    }
                }
                if (!$error) {
                    $view = $route_str[$url_len-1];
                    $view = $view[0] === '*' ? substr($view, 1) : $view;
                    $view = strpos($view,',') ? $url[$url_len-1] : $view;
                    $url_temp = $url;
                    foreach ($var_list as $value) {
                        if($value >= count($url)) {
                            break;
                        }
                        $url_temp[$value] = '*';
                    }
                    $view_name = '';
                    foreach ($url_temp as $value) {
                        $view_name = $view_name.'/'.$value;
                    }
                    if(array_key_exists($view_name, $GLOBALS['pages'])) {
                        $this->page = $view_name;
                    } else {
                        self::checkPage();
                    }
                }
            }
        } elseif (array_key_exists($base_url, $GLOBALS['pages'])) {
            $url_len = count($this->url);
            if($url_len > 1) {
                $this->page = '404';
            } elseif (!empty($GLOBALS['pages'][$base_url]['function'])) {
                // TODO: Throw error if function doesn't exist
                $this->page = $base_url;
            } else {
                self::checkPage($base_url);
            }
        } else {
            $this->page = '404';
        }
    }

    private function checkPage($page = NULL) {
        $page = $page === NULL ? $this->url[0] : $page;
        $template = $GLOBALS['pages'][$page]['template'];
        if (!empty($template) && file_exists('views/'.$template.'.php')) {
            $this->page = $page;
        } else {
            echo 'View not configured properly';
            die;
        }
    }
}