<?php

namespace backend\controllers\service;

use backend\models\CategoryForm;
use common\models\business\CategoryBusiness;
use common\models\output\Response;
use Yii;

class CategoryController extends ServiceController {

    public function init() {
        parent::init();
        $this->controller = "category";
    }

    /**
     * List category
     * @return type
     */
    public function actionGrid() {
        if (is_object($resp = $this->can("grid"))) {
            return $this->response($resp);
        }
        $category = CategoryBusiness::getAll();
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
        return CategoryBusiness::changeActive($id);
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
        return CategoryBusiness::changePosition($id, $position);
    }

    /**
     * Thêm mới danh mục
     * @return type
     */
    public function actionSave() {
        if (is_object($resp = $this->can("save"))) {
            return $this->response($resp);
        }
        $form = new CategoryForm();
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
        return $this->response(CategoryBusiness::remove($id));
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
        return $this->response(new Response(true, "Lấy danh mục tin tức thành công", CategoryBusiness::get($id)));
    }
}
