<?php 
class ajax {
    public function _index($url) {
        require_once 'ajax/init.php';

        header('Content-Type: application/json');
        echo json_encode(Initajax::init($url));
    }
}