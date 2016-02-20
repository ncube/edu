<?php
class Register extends Mvc {
	
	public function _index($arg){
        
        // TODO: Add from CSRF
		
		if(!empty(($arg['post']))) {
            $validate = Validate::register($arg['post']);
            if($validate === TRUE) {
                DB::addUser($arg['post']);
                echo 'Registered';
            } else {
                echo '<pre>';
                print_r($validate);
                echo '</pre>';
            }
		}else{
			self::init('RegisterModel','register',$arg);
		}

	}
}