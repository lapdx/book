<?php

namespace frontend\controllers\service;

use common\models\output\Response;
use Yii;
use yii\db\Exception;
use yii\rest\ActiveController;

class ServiceController extends ActiveController {

    protected $controller;

    public function init() {
        $this->modelClass = "common\models\db\Administrator";
    }

    public function response(Response $resp, $contentType = 'json') {
        Yii::$app->response->format = $contentType;
        return $resp;
    }

    public function can($action) {
        if (1 == 1)
            return true;
        if (Yii::$app->user->getId() == null) {
            return new Response(false, "You need to be logged in to perform this function,Click <a href='#auth/signin' title='signin system' >here</a> to login", []);
        }
        $action = strtolower($this->controller . '_' . $action);
        try {
            if (!Yii::$app->user->can($action)) {
                return new Response(false, "You do not have permission to perform this function", []);
            }
        } catch (Exception $exc) {
            return new Response(false, "You do not have permission to perform this function", $exc->getMessage());
        }

        return true;
    }

}
