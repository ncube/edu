<?php
$url = $GLOBALS['url_array'];
$question = new Question($url[1]);
$data['question'] = $question->getPublicQuestion();
$user = new User($data['question']['user_id']);
$user->getPublicData();
$user->getUserData();
$data['q_user'] = $user->user_data;

$data['question']['up_count'] = $question->getVoteUpCount();
$data['question']['answers_count'] = $question->getAnswersCount();

$answers = $question->getAnswers();
foreach ($answers as $key => $value) {
    $aUser = NULL;
    $aUser = new User();
    $aUser->getUserData();
    $aUser->getProfilePic();
    $answers[$key]['user'] = $aUser->user_data;
}
$data['answers'] = $answers;