<?php 
class DB {
    private static $_object = null;
    private $_conn,
    $_results,
    $_count = 0;

    private function __construct() {
        try {
            $this->_conn = new PDO('mysql:host='.$GLOBALS['config']['DB']['host'].';dbname='.$GLOBALS['config']['DB']['db'], $GLOBALS['config']['DB']['username'], $GLOBALS['config']['DB']['password']);
            $this->_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $error) {
            Log::error('db', $error);
            die('Sorry something went wrong please try again later.');
        }
    }

    public static function connect() {
        if (!isset(self::$_object)) {
            self::$_object = new DB();
        }
        return self::$_object;
    }

    public function query($sql, $data = array(), $fetch = false) {
        if ($query = self::connect()->_conn->prepare($sql)) {
            $x = 1;
            if (count($data)) {
                foreach($data as $param) {
                    $query->bindValue($x, $param);
                    $x++;
                }
            }

            try {
                $execute = $query->execute();
            } catch (PDOException $error) {
                Log::error('db', $error);
                die('Sorry something went wrong please try again later.');
            }


            if ($execute) {
                if ($fetch) {
                    $this->_results = $query->fetchAll(PDO::FETCH_OBJ);
                }
                $this->_count = $query->rowCount();
            } else {
                return FALSE;
            }
        }
        return $this;
    }

    public function insert($table, $fields = array()) {
        $keys = array_keys($fields);
        $value = '';
        $x = 1;

        foreach($fields as $field) {
            $values .= "?";
            if ($x < count($fields)) {
                $values .= ', ';
            }
            $x++;
        }

        $sql = "INSERT INTO ".'`'.$table.'` '."(`".implode('`, `', $keys)."`) VALUES ({$values})";
        if (!$this->query($sql, $fields)) {
            return TRUE;
        }
        return FALSE;
    }

    public function updateIf($table, $data, $a, $b) {

        foreach($data as $field => $value) {
            $update[] = '`'.$field.'` = \''.$value.'\'';
        }

        $sql = "UPDATE ".'`'.$table.'` SET '.implode(', ', $update)." WHERE `".$a."` = "."'".$b."'";
        return self::connect()->query($sql);
    }

    public function addUser($data) {
        $data['user_id'] = md5(uniqid(mt_rand, true));
        $data['password'] = Hash::generate($data['password']);

        unset($data['password_again']);

        echo '<pre>';
        print_r($data);
        echo '</pre>';

        self::connect()->insert('users', $data);
    }
}