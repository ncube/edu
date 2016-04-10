<?php 
class Post extends Mvc {
    public function _index($url) {

        $id = $url[0];

        if (!empty($url[0])) {
            $data = DB::fetch('post', array('unique_id' => $id));

            if (empty($data)) {
                echo 'Not Found';
                die();
            }

            if (!empty($url[1])) {
                switch ($url[1]) {
                    case 'comment':
                        $post = Input::post();
                        if (!empty($post)) {
                            if (Token::check($post['token'])) {
                                User::comment($url[0], $post['comment']);
                                echo 'Commented';
                            } else {
                                echo 'Security token missing';
                            }
                        } else {
                            Redirect::to('/post/'.$url[0]);
                        }
                        break;

                    default:
                        break;
                }
            }
        } else {
            Redirect::to('/');
        }
    }
}