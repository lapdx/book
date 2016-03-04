<?php

namespace backend\controllers\service;

use backend\models\MetaCategoryForm;
use backend\models\NewsCategoryForm;
use common\models\business\MetaCategoryBusiness;
use common\models\business\NewsCategoryBusiness;
use common\models\output\Response;
use Yii;

class NewscategoryController extends ServiceController {

    public function init() {
        parent::init();
        $this->controller = "newscategory";
    }

    /**
     * List category
     * @return type
     */
    public function actionGrid() {
        if (is_object($resp = $this->can("grid"))) {
            return $this->response($resp);
        }
        $category = NewsCategoryBusiness::getAll();
        return $this->response(new Response(true, "List category", $category));
    }

    /**
     * Change active
     * @return type
     */
    public function actionChangeactive() {
        if (is_object($resp = $this->can("changeactive"))) {
            return $this->response($resp);
        }
        $id = Yii::$app->request->get("id");
        return NewsCategoryBusiness::changeActive($id);
    }
    public function actionChangemenu() {
        if (is_object($resp = $this->can("changemenu"))) {
            return $this->response($resp);
        }
        $id = Yii::$app->request->get("id");
        return NewsCategoryBusiness::changeMenu($id);
    }

 
    /**
     * Thay đổi vị trí hiển thị của danh mục
     * @return type
     */
    public function actionChangeposition() {
        if (is_object($resp = $this->can("changeposition"))) {
            return $this->response($resp);
        }
        $id = \Yii::$app->request->get("id");
        $position = \Yii::$app->request->get("position");
        return NewsCategoryBusiness::changePosition($id, $position);
    }

    /**
     * Thêm mới danh mục
     * @return type
     */
    public function actionSave() {
        if (is_object($resp = $this->can("save"))) {
            return $this->response($resp);
        }
        $form = new NewsCategoryForm();
        $form->setAttributes(Yii::$app->request->getBodyParams());
        return $this->response($form->save());
    }

    /**
     * Xóa danh mục hiện hành
     * @return type
     */
    public function actionRemove() {
        if (is_object($resp = $this->can("remove"))) {
            return $this->response($resp);
        }
        $id = Yii::$app->request->get('id');
        return $this->response(NewsCategoryBusiness::remove($id));
    }

    /**
     * Lấy 1 danh mục
     * @return type
     */
    public function actionGetbyid() {
        if (is_object($resp = $this->can("getbyid"))) {
            return $this->response($resp);
        }
        $id = Yii::$app->request->get('id');
        return $this->response(new Response(true, "Lấy danh mục tin tức thành công", NewsCategoryBusiness::get($id)));
    }

}
