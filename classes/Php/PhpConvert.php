<?php
class PhpConvert {
    public function toArray($data) {
        $data = (array) $data;
        array_walk_recursive($data, function(&$value) {
            $value = (array) $value; 
        });
        return $data;
    }
}