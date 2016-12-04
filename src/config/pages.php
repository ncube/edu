<?php
$pages = array(
    'home' => array(
        'protect' => TRUE,
        'template' => 'index',
        'title' => 'Home - NCube School',
        'includes' => array(
            'css' => ['common'],
            'js' => array(
                'top' => [''],
                'bottom' => ['common']
            )
        ),
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
            'css' => ['common'],
            'js' => array(
                'top' => [''],
                'bottom' => ['common', 'inbox-ajax']
            )
        ),
        'content' => array(
            '-main-' => 'inbox.php'
        ),
        'data' => ['common', 'inbox']
    ),
    'profile' => array(
        'protect' => TRUE,
        'template' => 'index',
        'title' => 'Profile - NCube School',
        'includes' => array(
            'css' => ['common'],
            'js' => array(
                'top' => [''],
                'bottom' => ['common', 'profile-ajax']
            )
        ),
        'content' => array(
            '-main-' => ['profile.php', array('data' => ['profile'])]
        ),
        'data' => ['common', 'profile']
    ),
    'requests' => array(
        'protect' => TRUE,
        'template' => 'index',
        'title' => 'Requests - NCube School',
        'includes' => array(
            'css' => ['common'],
            'js' => array(
                'top' => [''],
                'bottom' => ['common']
            )
        ),
        'content' => array(
            '-main-' => ['requests.php', array('data' => ['requests'])]
        ),
        'data' => ['common', 'profile']
    ),
    'settings' => array(
        'protect' => TRUE,
        'template' => 'static',
        'title' => 'Settings - NCube School',
        'includes' => array(
            'css' => ['common'],
            'js' => array(
                'top' => [''],
                'bottom' => ['common']
            )
        ),
        'content' => array(
            '-main-' => ['settings.php']
        ),
        'data' => ['common']
    ),
    'questions' => array(
        'protect' => TRUE,
        'template' => 'index',
        'title' => 'Questions - NCube School',
        'includes' => array(
            'css' => ['common'],
            'js' => array(
                'top' => [''],
                'bottom' => ['common']
            )
        ),
        'content' => array(
            '-main-' => ['questionsList.php']
        ),
        'data' => ['common'],
        'var' => array(
            'ng-controller' => 'ng-controller="questionsList"',
        ),
    ),
    '/questions/*' => array(
        'protect' => TRUE,
        'template' => 'index',
        'title' => 'Questions - NCube School',
        'includes' => array(
            'css' => ['common'],
            'js' => array(
                'top' => [''],
                'bottom' => ['common']
            )
        ),
        'content' => array(
            '-main-' => ['questions.php']
        ),
        'data' => ['common', 'question'],
    ),
    '/questions/*/answer' => array(
        'protect' => TRUE,
        'function' => 'answerQuestion'
    ),
    '404' => array(
        'title' => 'Page Not Found - Ncube School',
        'template' => '404'
    ),
    'login' => array(
        'function' => 'login'
    ),
    'logout' => array(
        'function' => 'logout'
    ),
    'favicon.ico' => array(
        'function' => 'favicon'
    ),
    'register' => array(
        'function' => 'register'
    ),
);