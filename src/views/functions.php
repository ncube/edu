<?php
class Funcs {    
    public function login() {
            $post = Input::post();

            if (empty($post)) {
                header('Location: /');
                exit();
            }


            $validation = Validate::login($post);
            $token = Token::check($post['token']);


            $errors = NULL;
            
            if ($validation === TRUE && $token === TRUE) {
                if (!User::login($post['username'], $post['password'])) {
                    $errors = 'Username or Password is Incorrect'; 
                }
            } else {
                $errors = $validation;
                if (!$token) {
                    $errors = 'Security Token Missing';
                }
            }
            if (!empty($errors)) {
                // TODO: redirect to requested page
                Session::errors($errors, '/');
            }
    }

    public function answerQuestion() {
        if(!empty(Input::post())) {
            echo 'Under Construction';
            // $content = Input::post()['content'];
            // $id = $url[0];
            // Question::postAnswer($content, $id);
            // echo 'Posted';
        } else {                    
            echo '
                Post Answer
                <form method="post" action="">
                    <input type="text" placeholder="Answer" name="content">
                    <input type="submit" value="submit">
                </form>
            ';
        }
    }

    public function logout() {
        $token = Token::check(Input::post('token'));

        // TODO: Add token check support.
        $token = TRUE;

        if ($token) {
            // Destroy Session
            session_destroy();

            // Redirect to index
            Redirect::to('/');
        } else {
            echo 'Security Token Missing';
        }

    }

    public function favicon() {
        $file = 'favicon.ico';
        $type = 'image/jpeg';
        header('Content-Type:'.$type);
        header('Content-Length: ' . filesize($file));
        readfile($file);
    }

    public function register() {

        if (Session::exists('user_id')) {
            header('Location: /');
            exit();
        }
        
        $errors = Session::errors('errors');
        if (gettype($errors) === 'string') {
            $errors = array($errors);
        }



        $post = Input::post();

        if (!empty(($post)) && empty($errors)) {
            $validate = Validate::register($post);
            $token = Token::check($post['token']);
            if ($validate === TRUE && $token === TRUE) {
                User::addUser($post);
                echo 'Registered';
            } else {
                if (!$token) {
                    $errors[] = 'Security Token is missing';
                } else {
                    $errors = $validate;
                }
                Session::errors($errors, '/register');
            }
        } else {
            $data['title'] = 'Register - NCube School';
            $data['loginAction'] = '/login-process';
            $data['token'] = Token::generate();
            $data['errors'] = $errors;
            include 'views/register.php';
        }
    }
}