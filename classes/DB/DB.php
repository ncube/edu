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

    public function query($sql, $data = array(), $fetch = FALSE) {
        if ($query = self::connect()->_conn->prepare($sql)) {
            $x = 1;
            if ($data === TRUE) {
                $fetch = TRUE;
            } else {
                if (count($data)) {
                    foreach($data as $param) {
                        $query->bindValue($x, $param);
                        $x++;
                    }
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
                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                    $this->_results = $results;
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
        if (!self::connect()->query($sql, $fields)) {
            return TRUE;
        }
        return FALSE;
    }

    public function updateIf($table, $data, $condition, $logic = 'AND') {
    
        foreach($data as $field => $value) {
            $update[] = '`'.$field.'` = \''.$value.'\'';
        }
        
        $sql = "UPDATE ".'`'.$table.'` SET '.implode(', ', $update)." WHERE ";

        if (count($condition) === 1) {
            $key = array_keys($condition)[0];
            $sql .= "`".$key."` = '".$condition[$key]."'"; 
        } else {
            $i = 0;
            foreach($condition as $key => $value) {
                if ($i === 0) {
                    $sql .= "`".$key."` = '".$value."'";
                } else {
                    $sql .= " ".$logic." "."`".$key."` = '".$value."'";
                }
                $i++;
            }
        }
        return self::connect()->query($sql);
    }
    
    public function deleteIf($table, $data, $logic = 'AND') {

        if (count($data) === 1) {
            $sql = "DELETE FROM `".$table."` WHERE `".array_keys($data)[0]."` = '".array_values($data)[0]."'";
        } else {
            $sql = "DELETE FROM `".$table."` WHERE ";
            $i = 0;
            foreach($data as $key => $value) {
                if ($i === 0) {
                    $sql .= "`".$key."` = '".$value."'";
                } else {
                    $sql .= " ".$logic." "."`".$key."` = '".$value."'";
                }
                $i++;
            }
        }
        self::query($sql);
        return TRUE;
    }

    public function fetch($table, $data, $logic = 'AND') {

        $columns = '*';

        if (gettype($table) === 'array') {
            if (isset($table[0])) {
                $table = $table[0];
            } else {
                $columns = '';
                $tableData = $table;
                $table = array_keys($tableData)[0];
                $tableData = $tableData[$table];
                if (gettype($tableData) === 'string') {
                    $tableData = [$tableData];
                }
                $i = 0;
                foreach($tableData as $value) {
                    if ($i === 0) {
                        $columns .= '`'.$value.'`';
                    } else {
                        $columns .= ', `'.$value.'`';
                    }
                    $i++;
                }
            }
        }

        if (count($data) === 1) {
            $type = gettype($data[array_keys($data)[0]]);
            if ($type === 'array') {
                $key = array_keys($data)[0];
                $sql = "SELECT ".$columns." FROM `".$table."` WHERE ";
                $i = 0;
                foreach($data[$key] as $value) {                
                    if ($i === 0) {
                        $sql .= "`".$key."` = '".$value."'";
                    } else {
                        $sql .= " ".$logic." "."`".$key."` = '".$value."'";
                    }
                    $i++;
                }
            } else {
                $sql = "SELECT ".$columns." FROM `".$table."` WHERE `".array_keys($data)[0]."` = '".array_values($data)[0]."'";
            }
        } else {
            $sql = "SELECT ".$columns." FROM `".$table."` WHERE ";
            $i = 0;
            foreach($data as $key => $value) {                
                if ($i === 0) {
                    $sql .= "`".$key."` = '".$value."'";
                } else {
                    $sql .= " ".$logic." "."`".$key."` = '".$value."'";
                }
                $i++;
            }
        }
        self::query($sql, TRUE);
        return $this->_results;
    }

    public function fetchCount($table, $data, $logic = 'AND') {

        if (count($data) === 1) {
            $sql = "SELECT `user_id` FROM `".$table."` WHERE `".array_keys($data)[0]."` = '".array_values($data)[0]."'";
            self::query($sql, TRUE);
            return $this->_count;
        } else {
            $sql = "SELECT `user_id` FROM `".$table."` WHERE ";
            $i = 0;
            foreach($data as $key => $value) {
                if ($i === 0) {
                    $sql .= "`".$key."` = '".$value."'";
                } else {
                    $sql .= " ".$logic." "."`".$key."` = '".$value."'";
                }
                $i++;
            }
            self::query($sql, TRUE);
            return $this->_count;
        }
    }

    public function count() {
        return $this->_count;
    }
    
    public function search($table, $data, $logic = 'AND') {

        $columns = '*';

        if (gettype($table) === 'array') {
            if (isset($table[0])) {
                $table = $table[0];
            } else {
                $columns = '';
                $tableData = $table;
                $table = array_keys($tableData)[0];
                $tableData = $tableData[$table];
                if (gettype($tableData) === 'string') {
                    $tableData = [$tableData];
                }
                $i = 0;
                foreach($tableData as $value) {
                    if ($i === 0) {
                        $columns .= '`'.$value.'`';
                    } else {
                        $columns .= ', `'.$value.'`';
                    }
                    $i++;
                }
            }
        }

        if (count($data) === 1) {
            $type = gettype($data[array_keys($data)[0]]);
            if ($type === 'array') {
                $key = array_keys($data)[0];
                $sql = "SELECT ".$columns." FROM `".$table."` WHERE ";
                $i = 0;
                foreach($data[$key] as $value) {                
                    if ($i === 0) {
                        $sql .= "`".$key."` LIKE '%".$value."%'";
                    } else {
                        $sql .= " ".$logic." "."`".$key."` LIKE '%".$value."%'";
                    }
                    $i++;
                }
            } else {
                $sql = "SELECT ".$columns." FROM `".$table."` WHERE `".array_keys($data)[0]."` LIKE '%".array_values($data)[0]."%'";
            }
        } else {
            $sql = "SELECT ".$columns." FROM `".$table."` WHERE ";
            $i = 0;
            foreach($data as $key => $value) {                
                if ($i === 0) {
                    $sql .= "`".$key."` LIKE '%".$value."%'";
                } else {
                    $sql .= " ".$logic." "."`".$key."` LIKE '%".$value."%'";
                }
                $i++;
            }
        }
        
        self::query($sql, TRUE);
        return PhpConvert::toArray($this->_results);
    }
}