<?php
class Logout extends Mvc {
    public function _index($args) {
        
        // Destroy Session
        session_destroy();
        
        // Redirect to index
        Redirect::to('/');
    }
}