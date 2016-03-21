<?php 
class PhpConvert {
    public function toArray($data) {
        $data = (array) $data;
        array_walk_recursive($data, function(&$value) {
            $type = gettype($value);
            if ($type === 'object') {
                $value = (array) $value;
            }
        });
        return $data;
    }
}