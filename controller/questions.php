<?php 
class Questions extends Mvc {

    public function _index($url) {
        new Protect;

        self::init('QuestionsModel', 'questions', $url);
    }

    public function create() {
        $post = Input::post();
        echo '<pre>';
        if (!empty($post)) {
            if (Token::check($post['token'])) {
                Question::postQuestion($post);
                echo 'Posted';
            } else {
                echo 'Security token missing.';
            }
        } else {
            echo '
            <form method="post" action="">
                <input type="text" name="title" placeholder="Title">
                <input type="hidden" name="token" value="'.Token::generate().'">
                <br>
                <textarea placeholder="Description" type="text" name="content"></textarea>
                <br>
                <input type="submit">
            </form>
        ';
        }
    }
}