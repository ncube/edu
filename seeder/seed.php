<?php
// require the Faker autoloader
require_once 'vendor/fzaninotto/faker/src/autoload.php';
require_once '../src/config/Config.php';

// Auto Load Classes
spl_autoload_register(function($class) {
    // TODO: Move paths to config file.
    $paths = ['../src/classes/', '../src/classes/DB/', '../src/classes/Php/', '../src/classes/User/'];
    foreach($paths as $path) {
        $file = $path.$class.'.php';
        if (file_exists($file)) {
            require_once $file;
        }
    }
});

// Override Host
$GLOBALS['config']['DB']['host'] = "localhost:7072";

// Constants
define("u_iterations", $argv[1]);
define("f_iterations", $argv[2]);
define("q_iterations", $argv[3]);
define("a_iterations", $argv[4]);
define("m_iterations", $argv[5]);

// use the factory to create a Faker\Generator instance
$faker = Faker\Factory::create();
$db = DB::connect();

// Lists
$genders = ['male', 'female'];
$data = NULL;

function pSql($data) {
    $values = '';
    $x = 1;
    foreach($data as $field) {
        $values .= "'".$field."'";
        if ($x < count($data)) {
            $values .= ', ';
        }
        $x++;
    }

    return " ({$values}),";
}

// Seed Users
for ($i=0; $i < u_iterations; $i++) {
    $user_data['user_id'] = $faker->md5;
    $user_data['gender'] = $genders[array_rand($genders)];
    $p = filter_var($faker->password, FILTER_SANITIZE_MAGIC_QUOTES);
    // $p = htmlspecialchars($p);
    // $p = '$faker->password';
    $user_data['password'] = Hash::generate($p);
    $user_data['username'] = $faker->username;
    $user_data['first_name'] = filter_var($faker->firstName('male'), FILTER_SANITIZE_MAGIC_QUOTES);
    $user_data['last_name'] = filter_var($faker->lastName, FILTER_SANITIZE_MAGIC_QUOTES);
    $user_data['email'] = $faker->email;
    $data[$i] = $user_data;
    $data[$i]['raw_password'] = $p;
    $uSql .= pSql($user_data);
}
$db->eQuery('user', array_keys($user_data), $uSql);

// Get all User Ids
$Ids = PhpConvert::toArray($db->fetch(array('user' => ['user_id', 'username']), array('public' => 1)));

// Generate Follow Data
for ($i=0; $i < f_iterations; $i++) {
    $id1 = $Ids[array_rand($Ids)]['user_id'];
    $id2 = $Ids[array_rand($Ids)]['user_id'];
    if($id1 !== $id2) {
        $follow_id = $db->fetch(array('follow' => 'follow_id'), array('user_id' => $id1, 'following_id' => $id2));
        if (empty($follow_id)) {
            $fSql .= pSql(array('user_id' => $id1, 'following_id' => $id2, 'time' => time()));
            // Notif::raiseNotif($user_id, 'F');
        }
    }
}
$db->eQuery('follow', ['user_id', 'following_id', 'time'], $fSql);
// TODO: Clean Duplicate Records

// Generate Questions
for ($i=0; $i < q_iterations; $i++) {
    $q_data['user_id'] = $Ids[array_rand($Ids)]['user_id'];
    $q_data['title'] = $faker->sentence($nbWords = 6, $variableNbWords = true);
    $q_data['content'] = $faker->text($maxNbChars = 500);
    $q_data['q_id'] = md5(uniqid(mt_rand(), TRUE));
    $q_data['time'] = time();
    $q_data['public'] = 1;
    $q_data['views'] = 0;
    $qSql .= pSql($q_data);
}
$db->eQuery('question', array_keys($q_data), $qSql);

// Get all Question Ids
$qIds = PhpConvert::toArray($db->fetch(array('question' => ['q_id']), array('public' => 1)));

// Generate Answers
for ($i=0; $i < a_iterations; $i++) {
    $a_data['user_id'] = $Ids[array_rand($Ids)]['user_id'];
    $a_data['content'] = $faker->text($maxNbChars = 500);
    $a_data['q_id'] = $qIds[array_rand($qIds)]['q_id'];
    $a_data['time'] = time();
    $aSql .= pSql($a_data);
}
$db->eQuery('answer', array_keys($a_data), $aSql);

// Generate Messages
for ($i=0; $i < m_iterations; $i++) {
    $id1 = $Ids[array_rand($Ids)]['user_id'];
    $id2 = $Ids[array_rand($Ids)]['user_id'];
    if($id1 !== $id2) {
        $m_data['from_id'] = $id1;
        $m_data['to_id'] = $id2;
        $m_data['msg'] = $faker->text($maxNbChars = 30);
        $m_data['time'] = time();
        $mSql .= pSql($m_data);
    }
}
$db->eQuery('msg', array_keys($m_data), $mSql);


$input = file_get_contents('data.json');
$tempArray = json_decode($input);
array_push($tempArray, $data);

file_put_contents('data.json', json_encode($tempArray).PHP_EOL);