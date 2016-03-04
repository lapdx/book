<?php

namespace backend\controllers\service;

use backend\models\AssignmentForm;
use common\models\business\AdministratorBusiness;
use common\models\db\Administrator;
use common\models\input\AdministratorSearch;
use common\models\output\Response;
use Yii;

class AdministratorController extends ServiceController {

    public function init() {
        parent::init();
        $this->controller = Administrator::getTableSchema()->name;
    }

    /**
     * Search admin
     */
    public function actionGrid() {
        if (is_object($resp = $this->can("grid"))) {
            return $this->response($resp);
        }
        $search = new AdministratorSearch();
        $search->setAttributes(Yii::$app->request->get());
        return $this->response(new Response(true, "Danh sách admin", $search->search(true)));
    }

    /**
     * Change active
     * @return type
     */
    public function actionChangeactive() {
        if (is_object($resp = $this->can("changeactive"))) {
            return $this->response($resp);
        }
        $id = Yii::$app->request->get('id');
        return $this->response(AdministratorBusiness::changeActive($id));
    }

    /**
     * Assignment admin system
     * @return type
     */
    public function actionAssignment() {
        if (is_object($resp = $this->can("assignment"))) {
            return $this->response($resp);
        }
        $form = new AssignmentForm();
        $form->setAttributes($form->setAttributes(Yii::$app->request->getBodyParams()));
        return $this->response($form->save());
    }

    public function actionGetcode() {
        if (is_object($resp = $this->can("getcode"))) {
            return $this->response($resp);
        }
        $id = Yii::$app->request->get('id');
        $admin = AdministratorBusiness::get($id);
        $code = AdministratorBusiness::getCode($admin);
        return $this->response(new Response(true, '', ['code' => $code, 'id' => $id]));
    }

}
