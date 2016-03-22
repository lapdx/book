<?php

namespace backend\controllers\service;

use common\models\business\OrderBusiness;
use common\models\input\OrderSearch;
use common\models\output\Response;
use Yii;

class OrderController extends ServiceController {

    public function init() {
        parent::init();
        $this->controller = 'order';
    }

    /**
     * List news
     * @return type
     */
    public function actionGrid() {
        if (is_object($resp = $this->can("grid"))) {
            return $this->response($resp);
        }

        $form = new OrderSearch();
        $form->setAttributes(Yii::$app->request->get());
        return $this->response(new Response(true, "Lấy dữ liệu search thành công", $form->search(true)));
    }

    /**
     * Remove news
     * @return type
     */
    public function actionRemove() {
        if (is_object($resp = $this->can("remove"))) {
            return $this->response($resp);
        }
        $id = Yii::$app->request->get('id');
        return $this->response(OrderBusiness::remove($id));
    }

    public function actionGet() {
        if (is_object($resp = $this->can("get"))) {
            return $this->response($resp);
        }
        $id = Yii::$app->request->get('id');
        return $this->response(new Response(true,"",OrderBusiness::getInfor($id)));
    }
    public function actionChangeStatus() {
        if (is_object($resp = $this->can("change-status"))) {
            return $this->response($resp);
        }
        $status = Yii::$app->request->get('status');
        $id = Yii::$app->request->get('id');
        return $this->response(OrderBusiness::changeStatus($id, $status));
    }

}
