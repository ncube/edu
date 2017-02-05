<?php
class Log {
    public static function error($type, $error, $trace = TRUE) {
        $type = strtoupper($type);
        
        switch ($type) {
            case 'DB':
                $log = $error->getFile().'('.$error->getLine().')'.' ==>';
                
                if ($trace) {
                    $log .= $error;
                } else {
                    $log .= $error->getMessage();
                }
                break;
        }
        file_put_contents($GLOBALS['config']['logs']['path'],  date('F j Y h:i:s A') . ' - ' . $type . ' - ' . $log . "\n", FILE_APPEND);
    }
}