<?php 
class Utils {
    public function trim_array($data, $string) {
        $data = (array) $data;
        array_walk_recursive($data, function(&$value) {
            $value = rtrim($value, ',');
        });
        return $data;
    }

    public function parseUrl($url) {
        if (isset($url)) {
            return $url = explode('/', filter_var(rtrim($url, '/'), FILTER_SANITIZE_URL));
        }
    }
}