<?php 
// Warning: Input array keys are not sanitized
// TODO: strip get and post before sanitize
class Sanitize {
    public function nonDatabase() {

        // TODO: Clean and sanitize $_FILES
        $safe_data['files'] = $_FILES;

        // $safe_data['cookie'] = $_COOKIE;
        $safe_data['get'] = $_GET;
        $safe_data['post'] = $_POST;

        array_walk_recursive($safe_data, function(&$value) {
            $value = filter_var($value, FILTER_SANITIZE_MAGIC_QUOTES);
            $value = htmlspecialchars($value);
        });
        return $safe_data;
    }
}