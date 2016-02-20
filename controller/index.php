<?php
class Index extends Mvc {
    public function _index($args) {
        new Protect;
            echo 'Logged In';
    }
}