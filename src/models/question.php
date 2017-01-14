<?php
$url = $GLOBALS['url_array'];
$data['question'] = Question::getPublicQuestion($url[1])[0];
$data['q_user'] = User::getPublicUserData($data['question']['user_id'])[0];
$data['q_user']['profile_pic'] = User::getProfilePic($data['q_user']['profile_pic']);

$data['question']['up_count'] = Question::getVoteUpCount($data['question']['q_id']);
$data['question']['answers_count'] = Question::getAnswersCount($data['question']['q_id']);

$answers = Question::getAnswers($data['question']['q_id']);
foreach ($answers as $key => $value) {
    $answers[$key]['user'] = User::getPublicUserData($value['user_id'])[0];
    $answers[$key]['user']['profile_pic'] = User::getProfilePic($answers[$key]['user']['profile_pic']);
}
$data['answers'] = $answers;