<?php

namespace backend\controllers\service;

use backend\models\MetaNewsForm;
use backend\models\NewsForm;
use common\models\business\MetaNewsBusiness;
use common\models\business\NewsBusiness;
use common\models\business\NewsCategoryBusiness;
use common\models\db\News;
use common\models\input\NewsSearch;
use common\models\output\Response;
use Yii;

class NewsController extends ServiceController {

    public function init() {
        parent::init();
        $this->controller = News::getTableSchema()->name;
    }

    /**
     * List news
     * @return type
     */
    public function actionGrid() {
        if (is_object($resp = $this->can("grid"))) {
            return $this->response($resp);
        }

        $form = new NewsSearch();
        $form->setAttributes(Yii::$app->request->get());
        return $this->response(new Response(true, "Lấy dữ liệu search thành công", $form->search(true)));
    }

    /**
     * add news
     * @return type
     */
    public function actionAdd() {
        if (is_object($resp = $this->can("add"))) {
            return $this->response($resp);
        }

        $form = new NewsForm();
        $form->setAttributes(Yii::$app->request->getBodyParams());
        $form->createEmail = Yii::$app->user->getId();
        $form->updateEmail = Yii::$app->user->getId();
        $cateName = NewsCategoryBusiness::get($form->categoryId);
        $form->categoryName = $cateName->name;

        return $this->response($form->save());
    }

    /**
     * get by id
     * @return type
     */
    public function actionGetbyid() {
        if (is_object($resp = $this->can("getbyid"))) {
            return $this->response($resp);
        }
        $id = Yii::$app->request->get('id');
        return $this->response(new Response(true, "Lấy dữ liệu thành công", NewsBusiness::get($id)));
    }

    /**
     * change active
     * @return type
     */
    public function actionChangeactive() {
        if (is_object($resp = $this->can("changeactive"))) {
            return $this->response($resp);
        }
        $id = Yii::$app->request->get('id');
        return $this->response(NewsBusiness::changeActive($id));
    }
    /**
     * change active
     * @return type
     */
    public function actionChangehome() {
        if (is_object($resp = $this->can("changehome"))) {
            return $this->response($resp);
        }
        $id = Yii::$app->request->get('id');
        return $this->response(NewsBusiness::changeHome($id));
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
        return $this->response(NewsBusiness::remove($id));
    }
    

}
