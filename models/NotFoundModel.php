<?php
class NotFoundModel {
    public $data;
    
    public function __construct($args) {    
        $this->data['title'] = 'Not Found - NCube School of Knowledge';
        $this->data['url'] = $args['get']['url'];
    }
}