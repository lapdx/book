<?php

namespace frontend\controllers\service;

use common\models\output\Response;
use frontend\models\SiginForm;
use Yii;

class AuthController extends ServiceController {

    public function actionSignin() {
        if (Yii::$app->getSession()->get('customer') != null) {
            return $this->response(new Response(true, "Đăng nhập thành công", []));
        }
        $form = new SiginForm();
        $form->setAttributes(Yii::$app->request->getBodyParams());
        $resp = $form->signin();
        if ($resp->success) {
            Yii::$app->getSession()->set('customer', $resp->data);
        }
        return $this->response($resp);
    }
}
