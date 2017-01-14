<?php 
$data['title'] = 'Login - NCube School';
$data['loginAction'] = '/login-process';
$data['registerAction'] = '/register';
$data['token'] = Token::generate();

$errors = Session::errors('errors');
if (gettype($errors) === 'string') {
    $errors = array($errors);
}

$data['errors'] = $errors;