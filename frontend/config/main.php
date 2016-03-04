<?php

$params = array_merge(
        require(__DIR__ . '/../../common/config/params.php'), require(__DIR__ . '/params.php')
);

$url = require(__DIR__ . '/urlManager.php');

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'frontend\controllers',
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
        'view' => [
            'class' => '\rmrevin\yii\minify\View',
            'enableMinify' => !YII_DEBUG,
            'base_path' => '@frontend/public',
            'minify_path' => '@frontend/public/assets',
            'js_position' => [ \yii\web\View::POS_END],
            'force_charset' => 'UTF-8',
            'expand_imports' => true, // whether to change @import on content
        ],
        'urlManager' => $url,
    ],
    'params' => $params,
];
