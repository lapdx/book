<?php

namespace frontend\controllers;

use Yii;

class AuthController extends BaseController {

    /**
     * Trang chủ backend
     * @return type
     */
    public function actionIndex() {
        $session = Yii::$app->session;
        $session->addFlash('danger', [1=>'You have successfully deleted your post.']);
        var_dump($session->getFlash('danger'));return;
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
