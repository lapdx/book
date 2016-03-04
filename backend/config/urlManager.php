<?php

return [
    'class' => 'yii\web\UrlManager',
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'rules' => [
        //---default index
        '' => 'index/index',
        'index.php' => 'index/index',
        'index.html' => 'index/index',
    ],
];
