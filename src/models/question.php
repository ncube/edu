<?php
$question = new Question($GLOBALS['url_array'][1]);
$data['question'] = $question->getPublicQuestion();
$user = new User($data['question']['user_id']);
$user->getUserData();
$user->getProfilePic();
$data['q_user'] = $user->user_data;

$data['question']['up_count'] = $question->getVoteUpCount();
$data['question']['answers_count'] = $question->getAnswersCount();

$answers = $question->getAnswers();
foreach ($answers as $key => $value) {
    $aUser = NULL;
    $aUser = new User($value['user_id']);
    $aUser->getUserData();
    $aUser->getProfilePic();
    $answers[$key]['user_data'] = $aUser->user_data;
}
$data['answers'] = $answers;