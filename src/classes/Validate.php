<?php
class Validate {
    private $data = NULL;
    public $errors = FALSE;

    public function __construct($data) {
        $this->data = $data;
    }

    public function check($items = array()) {
        $source = $this->data;
        foreach($items as $item => $rules) {
            foreach($rules as $rule => $rule_value) {

                $value = trim($source[$item]);

                if ($rule === 'required' && empty($value)) {
                    $this->errors[] = "{$item} is required";
                } else if (!empty($value)) {
                    switch ($rule) {
                        case 'min':
                            if (strlen($value) < $rule_value) {
                                $this->errors[] = "{$item} must be a minimum of {$rule_value} characters.";
                            }
                            break;

                        case 'max':
                            if (strlen($value) > $rule_value) {
                                $this->errors[] = "{$item} must be a maximum of {$rule_value} characters.";
                            }
                            break;

                        case 'matches':
                            if ($value != $source[$rule_value]) {
                                $this->errors[] = "{$rule_value} must match {$item}";
                            }
                            break;
                            // TODO: Allow only unique username
                            // case 'unique':
                            //     // $check = $this->_db->get($rule_value, array($item,'=',$value));
                            //     if($check->count()) {
                            //         $this->errors[] = "{$item} already exists.";
                            //     }
                            //     break;

                        default:
                        $this->errors = NULL;
                            break;
                    }
                }

            }
        }

        if (empty($this->_errors)) {
            return TRUE;
        }
        return $this->_errors;
    }

    public function register() {
        return self::check(
            array(
                'username' => array(
                            'required' => TRUE,
                            'min' => 3,
                            'max' => 32,
                            'unique' => 'user'),
                'password' => array(
                            'required' => TRUE,
                            'min' => 6, ),
                'password_again' => array('matches' => 'password'),
                'first_name' => array(
                            'required' => TRUE,
                            'min' => 3,
                            'max' => 32),
                'last_name' => array(
                            'required' => TRUE,
                            'min' => 3,
                            'max' => 32),
                'email' => array(
                            'required' => TRUE),
            )
        );
    }
    
    public function login() {
        return self::check(
            array(
                'username' => array(
                            'required' => TRUE),
                'password' => array(
                            'required' => TRUE)
            )
        );
    }
}