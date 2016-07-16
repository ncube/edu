<?php 
class Messages extends Mvc {
    public function _index($url) {
        new Protect;
        self::init('MessagesModel', 'messages', $url);
    }
}