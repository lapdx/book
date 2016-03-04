<?php

namespace backend\controllers;

use common\models\business\ImageBusiness;
use common\models\enu\ImageType;

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
        $resp = ImageBusiness::dowload("http://www.blogtintuc.com/images/post/2014/05/16/01/13384/hot-girl-athena-tu-tin-khoe-3-vong-quotdap-rot-matquot-nguoi-xem--1394439854-531d76ae9c098.jpg", ImageType::_DEFAULT, $targetId = '0', $position = 0, $thumbnail = [[200, 200], [10, 10]]);
        var_dump($resp);
    }

}
