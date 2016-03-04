<?php

namespace frontend\controllers;

use Yii;

class ContactController extends BaseController {

    public function actionIndex() {
        $this->var['menuactive'] =Yii::$app->request->absoluteUrl;
        return $this->render("index", []);
    }

}
