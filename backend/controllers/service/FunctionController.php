<?php

namespace backend\controllers\service;

use backend\models\AuthGroupForm;
use backend\models\AuthItemForm;
use common\models\business\FunctionBusiness;
use common\models\output\Response;
use Yii;

class FunctionController extends ServiceController {

    public function init() {
        parent::init();
    }

    /**
     * Danh sách quyền trên hệ thống
     * @return type
     */
    public function actionGrid() {
        $resp = [];
        $resp["services"] = FunctionBusiness::getServices();
        $resp["groups"] = FunctionBusiness::getAuthGroup();
        $resp["items"] = FunctionBusiness::getAuthItem();
        $resp["itemChilds"] = FunctionBusiness::getAuthItemChilds();
        return $this->response(new Response(true, "Action service in Systen", $resp));
    }

    /**
     * tạo nhóm quyền
     */
    public function actionAuthgroupsave() {
        $form = new AuthGroupForm();
        $form->setAttributes($form->setAttributes(Yii::$app->request->getBodyParams()));
        return $this->response($form->save());
    }

    /**
     * 
     * @return type
     */
    public function actionAuthitemsave() {
        $form = new AuthItemForm();
        $form->setAttributes($form->setAttributes(Yii::$app->request->getBodyParams()));
        return $this->response($form->save());
    }

    /**
     * 
     * @return type
     */
    public function actionGetassignment() {
        $userId = Yii::$app->request->get("userId");
        $items = FunctionBusiness::getAuthItem();
        $service = [];
        foreach ($items as $item) {
            if ($item->type == 2) {
                continue;
            }
            $child = [];
            foreach ($items as $c) {
                if ($c->type == 1) {
                    continue;
                }
                if (preg_match('/^' . $item->name . '/', $c->name)) {
                    $child[] = $c;
                }
            }
            $item->setAttribute("child", $child);
            $service[] = $item;
        }

        $resp = [
            "assignments" => FunctionBusiness::getAssignmentByUserId($userId),
            "services" => $service,
            "groups" => FunctionBusiness::getAuthGroup(),
        ];
        return $this->response(new Response(true, "Services and assignments", $resp));
    }

}
