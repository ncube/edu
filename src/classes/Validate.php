<?php
class Validate {
    private $_errors = array();

    public function check($source, $items = array()) {
        foreach($items as $item => $rules) {
            foreach($rules as $rule => $rule_value) {

                $value = trim($source[$item]);

                if ($rule === 'required' && empty($value)) {
                    $this->_errors[] = "{$item} is required";
                } else if (!empty($value)) {
                    switch ($rule) {
                        case 'min':
                            if (strlen($value) < $rule_value) {
                                $this->_errors[] = "{$item} must be a minimum of {$rule_value} characters.";
                            }
                            break;

                        case 'max':
                            if (strlen($value) > $rule_value) {
                                $this->_errors[] = "{$item} must be a maximum of {$rule_value} characters.";
                            }
                            break;

                        case 'matches':
                            if ($value != $source[$rule_value]) {
                                $this->_errors[] = "{$rule_value} must match {$item}";
                            }
                            break;
                            // TODO: Allow only unique username
                            // case 'unique':
                            //     // $check = $this->_db->get($rule_value, array($item,'=',$value));
                            //     if($check->count()) {
                            //         $this->_errors[] = "{$item} already exists.";
                            //     }
                            //     break;

                        default:
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

    public function register($post) {
        return self::check(
            $post, array(
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
    
    public function login($post) {
        return self::check(
            $post, array(
                'username' => array(
                            'required' => TRUE),
                'password' => array(
                            'required' => TRUE)
            )
        );
    }
}