<?php 
class Mvc {
    public function model($model, $url = []) {
        require_once 'models/'.$model.'.php';
        return new $model($url);
    }

    public function view($view, $data = []) {
        require_once 'views/'.$view.'.php';
    }
    
    public function init($model, $view, $args = []) {
        // Get Model
        $model = $this->model($model, $args);
        
        // Generate View
        $this->view($view, $model->data);
    }
}