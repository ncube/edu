<?php
class NotFound extends Mvc {
    private $args;
    
    public function _index() {
        
        // Get Arguments
        $this->args = func_get_args()[0];
        
        // Set Header for 404
        header("HTTP/1.0 404 Not Found");
        
        // Get Model
        $model = $this->model('NotFoundModel', $this->args);
        
        // Generate View
        $this->view('NotFound', $model->data);
    }
}