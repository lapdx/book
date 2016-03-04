<?php

namespace backend\controllers;

class IndexController extends BaseController {

    /**
     * Trang chủ backend
     * @return type
     */
    public function actionIndex() {
        $imageConfig = \Yii::$app->params['image'];
        $this->staticClient = "var baseImage=" . json_encode($imageConfig);
        return $this->render('view');
    }

    public function actionPhp() {
        phpinfo();
    }

}
