<?php
class NotFoundModel {
    public $data;
    
    public function __construct($url) {    
        $this->data['title'] = 'Not Found - NCube School of Knowledge';
        $this->data['url'] = $url;
    }
}