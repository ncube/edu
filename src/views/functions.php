<?php
class Funcs {    
    public static function login() {
            $post = Input::post();

            if (empty($post)) {
                header('Location: /');
                exit();
            }


            $validate = new Validate($post);
            $validate->login();
            $token = Token::check($post['token']);


            $errors = NULL;
            
            if ($validate->errors === NULL && $token === TRUE) {
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

    public static function answerQuestion() {
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

    public static function logout() {
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

    public static function favicon() {
        $file = 'favicon.ico';
        $type = 'image/jpeg';
        header('Content-Type:'.$type);
        header('Content-Length: ' . filesize($file));
        readfile($file);
    }

    public static function register() {

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
            $validate = new Validate($post);
            $validate->register();
            $token = Token::check($post['token']);
            if ($validate->errors === NULL && $token === TRUE) {
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

    public static function changepic() {
        $input = Input::get();
        $token = Token::generate();
        $crop = isset($input['crop']) ? $input['crop'] : FALSE;
        if($crop) {
            $src = Session::get('ppic_path');
            $name = Session::get('ppic_name');
            $type = Session::get('ppic_type');
            
            $image = new Image($src, $type);
            $image->crop($input['x'], $input['y'], $input['width'], $input['height']);

            $image->scale(200, 200);
            $image->save('data/images/profile/200/'.$name);

            $image->scale(35, 35);
            $image->save('data/images/profile/35/'.$name);

            $image->destroy();

            echo $image->saved ? 'Uploaded' : 'Can\'t upload please try again later';
        } elseif(!empty(Input::files())) {
            // TODO: Add token check
            $name = Input::files()['uploaded_file']['name'];
            $src = new Upload;
            $src->profilePic(Input::files());
            if ($src->uploaded) {
                $path = $src->path;
                $name = $src->name;
                $type = $src->type;
                Session::create('ppic_path', $path);
                Session::create('ppic_name', $name);
                Session::create('ppic_type', $type);
                include 'crop.php';
            } else {
                print_r($src->errors);
                die;
            }
        } else {
            echo '
                <form enctype="multipart/form-data" action="" method="post">
                    <input type="hidden" name="token" value="'.$token.'" />
                    <input type="hidden" name="MAX_FILE_SIZE" value="5120000" />
                    <input name="uploaded_file" type="file">
                    <input type="submit" class="btn btn-primary" value="Upload" />
                </form>
            ';
        }
    }

    public static function createGroup() {
        $input = Input::post();
        if(!empty($input)) {
            if (!empty($input['name'] && isset($input['public']))) {
                $group = new Group;
                $group->create($input);
                echo $group->group_created ? 'Group Created' : 'Unable to create group';
            } else {
                echo 'Group name and group type is required';
            }
        } else {
            echo '
                <form method="post" action="">
                    <input type="text" name="name" placeholder="Group Name"/>
                    <br><br>
                    <input type="text" name="description" placeholder="Group Description"/>
                    <br><br>
                    <input type="text" name="parent" placeholder="Parent Group ID"/>
                    <br><br>
                    <select name="public">
                        <option selected disabled value="">Public</option>
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                    <input type="submit" value="Submit">
                </form>
            ';
        }
    }
}