<?php 
class LoadController {

    private static $_init = NULL;
    public $output;

    protected $controller = 'NotFound';

    protected $method = '_index';

    protected $params = [];

    protected $safe_data = [];

    private function __construct($safe_data) {


        $this->safe_data = $safe_data;
        $url = $this->parseUrl($this->safe_data['get']['url']);

        if ($url[0] === 'index.php') {
            $url[0] = preg_replace('/\\.[^.\\s]{3,4}$/', '', $url[0]);
        }

        if (file_exists('controller/'.$url[0].'.php')) {
            $this->controller = $url[0];
            unset($url[0]);
        }
        require_once 'controller/'.$this->controller.'.php';

        $this->controller = new $this->controller;

        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        $this->safe_data['url'] = $url ? array_values($url) : [];

        call_user_func_array([$this->controller, $this->method], array($this->safe_data));
    }

    private function parseUrl($url) {
        if (isset($url)) {
            return $url = explode('/', filter_var(rtrim($url, '/'), FILTER_SANITIZE_URL));
        }
    }

    public function init($safe_data = []) {
        if (!isset(self::$_init)) {
            self::$_init = new LoadController($safe_data);
        }
        return self::$_init;
    }
}