<?php 
class Logout extends Mvc {
    public function _index() {

        // Destroy Session
        session_destroy();

        // Redirect to index
        Redirect::to('/');
    }
}