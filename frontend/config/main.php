<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'layout' => 'mylayout',
    'controllerNamespace' => 'frontend\controllers',
    'modules' => [
        'Project' => [
            'class' => 'frontend\Modules\Project\project',
            // ... other configurations for the module ...
        ],
    ],
    'components' => [



        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],

        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],

        'session' => [
            'name' => 'advanced-frontend',
        ],

        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],

        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
//                'dashboard' => 'site/index',
//                'users' => 'user/index',
//                'registration' => 'user/registration',
//                '<action>' => 'site/<action>',

            ],
        ],

    ],



    'params' => $params,
];
