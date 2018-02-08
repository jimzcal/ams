<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log', 'thumbnail'],
    'modules' => [
        'pdfjs' => ['class' => '\yii2assets\pdfjs\Module',],
        'rbac' => [
            'class' => 'dektrium\rbac\RbacWebModule',
        ],
        'user' => [
            'class'  => 'dektrium\user\Module',
            'admins' => ['admin'],
            'enableFlashMessages' => false,
        ],
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
            ],

            'thumbnail' => [
        'class' => 'himiklab\thumbnail\EasyThumbnail',
        'cacheAlias' => 'assets/gallery_thumbnails',
                ],
    
        // 'user' => [
        //     'identityClass' => 'backend\models\User',
        //     'enableAutoLogin' => true,
        //     'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        // ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],

        'authManager'  => [
                'class' => 'dektrium\rbac\components\DbManager',
                ],

         'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '[DIFFERENT UNIQUE KEY]',
            'csrfParam' => '_backendCSRF',
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
            'enablePrettyUrl' => false,
            'showScriptName' => false,

            // 'rules' => [
            // ],
        ],
        
    ],
    'params' => $params,
];
