<?php
class Funcs {
    public function profileRequest() {
        new Protect;

        echo 'Request Code Goes Here';
        
        // $post = Input::post();
        // $token = Token::check($post['token']);
        
        // if (isset($post['type']) && !empty($post['type'] && $token === TRUE)) {
        //     $request = User::request($post);
        //     if ($request !== TRUE) {
        //         echo $request;
        //     } else {
        //         echo TRUE;
        //     }
        // } else {
        //     if (!empty($post['username'] && $token === TRUE)) {
        //         echo '
        //         <form action="/profile/'.$post['username'].'/request" method="post">
        //         <input type="hidden" name="token" value="'.Token::generate().'">
        //         <input type="hidden" name="username" value="'.$post['username'].'">
        //         <select name="type">
        //         <option value="C">Classmate</option>
        //         <option value="T">Teacher</option>
        //         <option value="S">Student</option>
        //         <option value="F">Friend</option>
        //         <option value="P">Parent or Guardian</option>
        //         </select>
        //         <input type="submit" value="Send Request">
        //         </form>
        //         ';
        //     } else {
        //         if (!$token) {
        //             echo 'Security Token Missing';
        //         } else {
        //             Redirect::to('/profile');
        //         }
        //     }
        // }
    }

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
}