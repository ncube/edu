<?php
$data['question'] = Question::getPublicQuestion($url['args'][0])[0];
$data['q_user'] = User::getPublicUserData($data['question']['user_id'])[0];
$data['q_user']['profile_pic'] = User::getProfilePic($data['q_user']['profile_pic']);

$data['question']['up_count'] = Question::getVoteUpCount($data['question']['q_id']);
$data['question']['down_count'] = Question::getVoteDownCount($data['question']['q_id']);
$data['question']['level'] = Question::getDifficultyLevel($data['question']['q_id']);
$data['question']['answers_count'] = Question::getAnswersCount($data['question']['q_id']);

$answers = Question::getAnswers($data['question']['q_id']);
foreach ($answers as $key => $value) {
    $answers[$key]['user'] = User::getPublicUserData($value['user_id'])[0];
    $answers[$key]['user']['profile_pic'] = User::getProfilePic($answers[$key]['user']['profile_pic']);
}
$data['answers'] = $answers;