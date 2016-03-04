<?php

namespace backend\controllers\service;

use backend\models\PartnersForm;
use common\models\business\PartnersBusiness;
use common\models\db\Partners;
use common\models\input\PartnersSearch;
use common\models\output\Response;
use Yii;

class PartnersController extends ServiceController {

    public function init() {
        parent::init();
        $this->controller = Partners::getTableSchema()->name;
    }

    /**
     * Search admin
     */
    public function actionGrid() {
        if (is_object($resp = $this->can("grid"))) {
            return $this->response($resp);
        }
        $search = new PartnersSearch();
        $search->setAttributes(Yii::$app->request->get());
        return $this->response(new Response(true, "Danh đối tác", $search->search(true)));
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
        return $this->response(PartnersBusiness::changeActive($id));
    }

    public function actionChangehome() {
        if (is_object($resp = $this->can("changehome"))) {
            return $this->response($resp);
        }
        $id = Yii::$app->request->get('id');
        return $this->response(PartnersBusiness::changeHome($id));
    }

    public function actionChangeposition() {
        if (is_object($resp = $this->can("changeposition"))) {
            return $this->response($resp);
        }
        $id = Yii::$app->request->get("id");
        $position = Yii::$app->request->get("position");
        return PartnersBusiness::changePosition($id, $position);
    }

    /**
     * 
     * @return type
     */
    public function actionChange() {
        if (is_object($resp = $this->can("change"))) {
            return $this->response($resp);
        }
        $form = new PartnersForm();
        $form->setAttributes(Yii::$app->request->getBodyParams());
        return $this->response($form->save());
    }

    /**
     * Xóa menu, danh mục có chứa menu con thì đéo được xóa
     * @return type
     */
    public function actionRemove() {
        if (is_object($resp = $this->can("remove"))) {
            return $this->response($resp);
        }
        $id = Yii::$app->request->get("id");
        return PartnersBusiness::remove($id);
    }

    public function actionGet() {
        if (is_object($resp = $this->can("get"))) {
            return $this->response($resp);
        }
        $id = Yii::$app->request->get('id');
        $partners = PartnersBusiness::get($id);
        return $this->response(new Response(true, "", $partners));
    }

    public function actionGetall() {
        if (is_object($resp = $this->can("getall"))) {
            return $this->response($resp);
        }
        return $this->response(new Response(true,"",  PartnersBusiness::getAll("",true)));
    }

}
