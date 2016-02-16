<?php 
class Mvc {
    public function model($model, $url = []) {
        require_once 'models/'.$model.'.php';
        return new $model($url);
    }

    public function view($view, $data = []) {
        require_once 'views/'.$view.'.php';
    }
}