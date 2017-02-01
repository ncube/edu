<?php 
class Restrict {
    public static function data($data, $allowed, $type = 'key') {
        foreach($allowed as $value) {
            if (in_array($value, array_keys($data))) {
                $safe_data[$value] = $data[$value];
            }
        }
        return $safe_data;
    }
}