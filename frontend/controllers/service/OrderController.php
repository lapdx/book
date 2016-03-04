<?php

namespace frontend\controllers\service;

use common\models\business\OrderBusiness;
use common\models\output\Response;
use frontend\models\OrderForm;
use Yii;

class OrderController extends ServiceController {

    public function actionAddtocart() {
        $itemId = Yii::$app->request->get('id');
        $quantity = Yii::$app->request->get('quantity');
        return $this->response(OrderBusiness::addToCart($itemId, $quantity));
    }

    /**
     * Xóa sản phẩm khỏi cart
     * @return type
     */
    public function actionRemovefromcart() {
        $itemId = Yii::$app->request->get('id');
        return $this->response(OrderBusiness::removeFromCart($itemId));
    }

    /**
     * cập nhật số lượng sản phẩm
     * @return type
     */
    public function actionUpdatecart() {
        $itemId = Yii::$app->request->get('id');
        $quantity = Yii::$app->request->get('quantity');
        return $this->response(OrderBusiness::updateCart($itemId, $quantity));
    }

    public function actionRemovecarts() {
        return $this->response(OrderBusiness::removeCarts());
    }

    public function actionGetcart() {
        return $this->response(new Response(true, "", OrderBusiness::getCart()));
    }

    /**
     * Save đơn hàng
     * @return type
     */
    public function actionSave() {
        $form = new OrderForm();
        $form->setAttributes(Yii::$app->request->getBodyParams());
        return $this->response($form->save());
    }

}
