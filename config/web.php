<?php

$params = require(__DIR__ . '/params.php');
$db = require(__DIR__ . '/db.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'name'=>'快餐系统',
    'bootstrap' => ['log'],
    'language' => 'zh-CN',
    'timeZone'=>'Asia/Chongqing',
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'G0O0Eewrl2tIRrWSKRr4dBlniQwLqbf8',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'admin' => [
            'class'=>'\yii\web\User',
            'identityClass'=>'app\modules\admin\models\Administrator',
            'idParam' => '__aid',
            'loginUrl'=>['/admin/default/login']
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\DbTarget',
                    'levels' => ['error', 'warning'],
                    'categories'=>['order']
                ],
            ],
        ],
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '/<controller:\w+>-<action:\w+>.html'=>'/<controller>/<action>',
                '/admin/<controller:\w+>-<action:\w+>.html'=>'/admin/<controller>/<action>',
                '/wechat/<controller:\w+>-<action:\w+>.html'=>'/wechat/<controller>/<action>',

            ],
        ],
    ],
    'params' => $params,

    'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\Module',
            'layout'=>'main'
        ],
        'wechat' => [
            'class' => 'app\modules\wechat\Module',
            'layout' => 'main'
        ],
    ],
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
