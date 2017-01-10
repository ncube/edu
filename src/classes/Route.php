<?php
class Route {
    public $page;
    public $url;
    public $url_array;
    public $view;
    
    public function __construct() {
        $this->url = $GLOBALS['url'];
        $this->url_array = $GLOBALS['url_array'];
        $this->view = NULL;
        $this->page = '404';
        $type =  $this->url_array[0] === 'ajax' ? 'ajax' : NULL;

        self::check($type);
    }
    
    private function check($type) {
        if ($type === 'ajax') {
            $routes = $GLOBALS['routes_ajax'];
        } else {
            $routes = $GLOBALS['routes'];
        }
        $url_array = $this->url_array;
        $url_len = count($this->url_array);
        
        foreach($routes as $key => $value) {
            $str = explode('/', rtrim($key, '/'));
            $str_count = count($str);
            if($str_count === $url_len) {
                $this->page = $key;
                foreach ($url_array as  $key2 => $value2) {
                    if(!($value2 === $str[$key2])) {
                        if($str[$key2] !== '*') {
                            $this->page = '404';
                            break;
                        }
                    }
                }
                if($this->page !== '404') {
                    break;
                }
            }
        }
    }
}