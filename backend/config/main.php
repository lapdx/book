<?php

$params = array_merge(
        require(__DIR__ . '/../../common/config/params.php'), require(__DIR__ . '/params.php')
);

$url = require(__DIR__ . '/urlManager.php');

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log', 'gii'],
    'modules' => [
        'gii' => 'yii\gii\Module',
    ],
    'components' => [
        'request' => [
            'cookieValidationKey' => '8k1y4XezFg2PktNFsn4rlktz6eOiYBdd',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'user' => [
            'identityClass' => 'backend\models\auth\Auth',
            'enableAutoLogin' => true,
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
            'errorAction' => 'error/action',
        ],
		'authManager' => array(
            'class' => 'yii\rbac\DbManager',
        ),
        'urlManager' => $url,
    ],
    'params' => $params,
];
