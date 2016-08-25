<?php 
class Questions extends Mvc {

    public function _index($url) {
        new Protect;

        if (!empty($url[0])) {
            if (Question::exists($url[0])) {
                self::init('QuestionsModel', 'questions', $url);
            } else {
                echo 'Question not found';
            }
        } else {
            self::init('QuestionsListModel', 'questionsList', $url);
        }
    }

    public function create() {
        new Protect;
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