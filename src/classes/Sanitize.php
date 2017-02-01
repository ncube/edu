<?php 
// Warning: Input array keys are not sanitized
// TODO: strip get and post before sanitize
class Sanitize {

    private $raw_data;
    public $safe_data;

    public function __construct($data = NULL) {
        $raw_data['files'] = $_FILES;
        // $safe_data['cookie'] = $_COOKIE;
        $raw_data['get'] = $_GET;
        $raw_data['post'] = $_POST;

        $this->raw_data = ($data === NULL) ? $raw_data : $data;
        $this->safe_data = NULL;
    }

    public function nonDatabase() {
        $raw_data = $this->raw_data;
        array_walk_recursive($raw_data, function(&$value) {
            $value = filter_var($value, FILTER_SANITIZE_MAGIC_QUOTES);
            $value = htmlspecialchars($value);
        });
        $this->safe_data = $raw_data;
    }
}