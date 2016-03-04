<?php

namespace frontend\controllers;

use common\models\business\OrderBusiness;
use common\models\input\ItemSearch;
use Yii;

class OrderController extends BaseController {

    public function actions() {
        return [
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
            ],
        ];
    }

    /**
     * Trang chủ backend
     * @return type
     */
    public function actionCheckout() {
        $orderInfo = OrderBusiness::getCart();
        $this->var['checkout'] =1;
        return $this->render('checkout', [
                    'order' => $orderInfo,
                        ]
        );
    }
    public function actionComplete() {
        $order = OrderBusiness::get(\Yii::$app->request->get('id'));
        $this->var['checkout'] =1;
        return $this->render('complete', [
                    'order' => $order,
                        ]
        );
    }
    public function actionDetail() {
        $order = OrderBusiness::get(\Yii::$app->request->get('id'));
        $this->var['checkout'] =1;
        return $this->render('detail', [
                    'order' => $order,
                        ]
        );
    }

}
