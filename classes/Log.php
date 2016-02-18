<?php
class Log {
    public function error($type, $error) {
        file_put_contents('logs/error.log',  date('F j Y h:i:s A') . ' - ' . strtoupper($type) . ' - ' . $error . "\n", FILE_APPEND);
    }
}