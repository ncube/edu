<?php
$routes = array(
    'index' => array(
        'protect' => TRUE,
        'template' => 'index',
        'title' => 'Home - NCube School',
        'content' => array(
            '-main-' => 'home.html'
        ),
        'data' => ['common']
    ),
    'inbox' => array(
        'protect' => TRUE,
        'template' => 'static',
        'title' => 'Inbox - NCube School',
        'includes' => array(
            'js' => array(
                'bottom' => ['inbox-ajax']
            )
        ),
        'content' => array(
            '-main-' => 'inbox.php'
        ),
        'data' => ['common', 'inbox']
    ),
    'inbox/*' => array(
        'parent' => TRUE
    ),
    'profile' => array(
        'protect' => TRUE,
        'template' => 'index',
        'title' => 'Profile - NCube School',
        'includes' => array(
            'js' => array(
                'bottom' => ['profile-ajax']
            )
        ),
        'content' => array(
            '-main-' => ['profile.php', array('data' => ['profile'])]
        ),
        'data' => ['common', 'profile']
    ),
    'profile/changepic' => array(
        'function' => 'changepic',
        'data' => ['common']
    ),
    'profile/*' => array(
        'parent' => TRUE
    ),
    'questions' => array(
        'protect' => TRUE,
        'template' => 'index',
        'title' => 'Questions - NCube School',
        'content' => array(
            '-main-' => ['questionsList.php']
        ),
        'data' => ['common'],
        'var' => array(
            'ng-controller' => 'ng-controller="questionsList"',
        ),
    ),
    'questions/create' => array(
        'protect' => TRUE,
        'template' => '404',
        'title' => 'Page Not Found'
    ),
    'questions/*' => array(
        'protect' => TRUE,
        'template' => 'index',
        'title' => 'Questions - NCube School',
        'content' => array(
            '-main-' => ['questions.php']
        ),
        'data' => ['common', 'question'],
    ),
    'questions/*/answer' => array(
        'protect' => TRUE,
        'function' => 'answerQuestion'
    ),
    'settings' => array(
        'protect' => TRUE,
        'template' => 'static',
        'title' => 'Settings - NCube School',
        'content' => array(
            '-main-' => ['settings.php']
        ),
        'data' => ['common']
    ),  
    'settings/general' => array(
        'parent' => TRUE
    ),
    'settings/privacy' => array(
        'parent' => TRUE
    ),
    'settings/security' => array(
        'parent' => TRUE
    ),
    'settings/notifications' => array(
        'parent' => TRUE
    ),
    'register' => array(
        'function' => 'register'
    ),
    'login' => array(
        'title' => 'Login - NCube School',
        'template' => 'login',
        'data' => ['login']
    ),
    'login-process' => array(
        'function' => 'login'
    ),
    'logout' => array(
        'function' => 'logout'
    ),
    'favicon.ico' => array(
        'function' => 'favicon'
    ),
    '404' => array(
        'title' => 'Page Not Found - Ncube School',
        'template' => '404'
    ),
);