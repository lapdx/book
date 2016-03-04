<?php

namespace backend\controllers\service;

use backend\models\HomeForm;
use common\models\business\ContactBusiness;
use common\models\business\HomeBusiness;
use common\models\db\Home;
use common\models\output\Response;
use Yii;

class HomeController extends ServiceController {

    public function init() {
        parent::init();
        $this->controller = Home::getTableSchema()->name;
    }

    /**
     * sửa xóa
     */
    public function actionChange() {
        if (is_object($resp = $this->can("change"))) {
            return $this->response($resp);
        }
        $form = new HomeForm();
        $form->setAttributes(Yii::$app->request->getBodyParams());
        return $this->response($form->save());
    }

    /**
     * Get Banner
     */
    public function actionGet() {
        if (is_object($resp = $this->can("get"))) {
            return $this->response($resp);
        }
        $id = Yii::$app->request->get('id');
        return $this->response(new Response(true, "Lấy dữ liệu thành công", HomeBusiness::get($id)));
    }

}
