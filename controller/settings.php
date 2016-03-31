<?php 
class Settings extends Mvc {
    public function _index($url) {
        new Protect;

        self::init('SettingsModel', 'settings', $url);
    }
}