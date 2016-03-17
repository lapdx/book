<?php

namespace frontend\controllers;

use Yii;

class AuthController extends BaseController {

    /**
     * Trang chủ backend
     * @return type
     */
    public function actionIndex() {
        $user = Yii::$app->getSession()->get("customer");
        if(!empty($user)){
            return $this->redirect($this->baseUrl);
        }
        return $this->render('login');
    }
    public function actionLogout() {
        Yii::$app->getSession()->set("customer",null);
        return $this->redirect($this->baseUrl);
    }
    public function actionSignup(){
        return $this->render('signup');
    }
}
