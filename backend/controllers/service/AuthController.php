<?php

namespace backend\controllers\service;

use backend\models\auth\Auth;
use backend\models\SiginForm;
use common\models\output\Response;
use Yii;

class AuthController extends ServiceController {

    public function init() {
        parent::init();
    }

    /**
     * 
     * @return type
     */
    public function actionSignin() {
        if (Yii::$app->user->getId() != null) {
            return $this->response(new Response(true, "Admin account logged in the system", "#index/grid"));
        }
        $form = new SiginForm();
        $form->setAttributes(Yii::$app->request->getBodyParams());
        $resp = $form->signin();
        if ($resp->success) {
            $auth = new Auth();
            $auth->id = $resp->data->id;
            $auth->authKey = md5($resp->data->id . "-bapcai.vn29-" . $resp->data->joinTime);
            Yii::$app->user->login($auth, 1);
        }
        return $this->response($resp);
    }

    /**
     * 
     * @return type
     */
    public function actionSigout() {
        if (Yii::$app->user->getId() != null) {
            Yii::$app->user->logout();
        }
        return $this->response(new Response(true, "Admin account sigout", "#auth/signin"));
    }

}
