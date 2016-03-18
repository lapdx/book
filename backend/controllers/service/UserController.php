<?php

namespace backend\controllers\service;

use backend\models\AssignmentForm;
use backend\models\UserForm;
use common\models\business\UserBusiness;
use common\models\db\User;
use common\models\input\UserSearch;
use common\models\output\Response;
use Yii;

class UserController extends ServiceController {

    public function init() {
        parent::init();
        $this->controller = User::getTableSchema()->name;
    }

    /**
     * Search admin
     */
    public function actionGrid() {
        if (is_object($resp = $this->can("grid"))) {
            return $this->response($resp);
        }
        $search = new UserSearch();
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
        return $this->response(UserBusiness::changeActive($id));
    }

    public function actionRemove() {
        if (is_object($resp = $this->can("remove"))) {
            return $this->response($resp);
        }
        $id = Yii::$app->request->get('id');
        return $this->response(UserBusiness::remove($id));
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

    public function actionSave() {
        if (is_object($resp = $this->can("save"))) {
            return $this->response($resp);
        }
        $form = new UserForm();
        $form->setAttributes(Yii::$app->request->getBodyParams());

        return $this->response($form->save());
    }

    public function actionGetbyid() {
        if (is_object($resp = $this->can("getbyid"))) {
            return $this->response($resp);
        }
        $id = Yii::$app->request->get('id');
        return $this->response(new Response(true, "Lấy dữ liệu thành công", UserBusiness::get($id)));
    }

}
