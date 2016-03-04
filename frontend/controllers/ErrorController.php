<?php

namespace frontend\controllers;

use common\models\business\EmailBusiness;

class ErrorController extends BaseController {

    public function actions() {
        return [
            'action' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function action404() {
        echo "404";
    }

    public function actionTest() {
        EmailBusiness::send("xuanlap93@gmail.com", "test","order",['a'=>'lap']);
    }

}
