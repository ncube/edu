<?php
class Register extends Mvc {
	
	public function _index($arg){
		
		if(!empty(($arg['post']))) {
			?><pre><?php
			print_r($arg['post']);
			?></pre><?php
		}else{

			self::init('RegisterModel','register',$arg);
		}

	}
}