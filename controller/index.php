<?php
class Index extends Mvc {
    public function _index() {
        
        // Get Model
        $model = $this->model('IndexModel');
        
        // Generate View
        $this->view('Index', $model->data);
    }
}