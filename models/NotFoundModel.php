<?php
class NotFoundModel {
    public $data;
    
    public function __construct($path) {    
        $this->data['title'] = 'Not Found - NCube School of Knowledge';
        $this->data['url'] = $path;
    }
}