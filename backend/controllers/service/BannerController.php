<?php

namespace backend\controllers\service;

use backend\models\BannerForm;
use backend\models\MetaIndexForm;
use common\models\business\BannerBusiness;
use common\models\business\MetaIndexBusiness;
use common\models\db\Banner;
use common\models\input\BannerSearch;
use common\models\output\Response;
use Yii;

class BannerController extends ServiceController {

    public function init() {
        parent::init();
        $this->controller = Banner::getTableSchema()->name;
    }

    /**
     * Danh sách banner
     */
    public function actionGrid() {
        if (is_object($resp = $this->can("grid"))) {
            return $this->response($resp);
        }
        $search = new BannerSearch();
        $search->setAttributes(Yii::$app->request->get());
        return $this->response(new Response(true, "Lấy dữ liệu thành công", $search->search(true)));
    }

    /**
     * Thay đổi trạng thái banner
     */
    public function actionChangeactive() {
        if (is_object($resp = $this->can("changeactive"))) {
            return $this->response($resp);
        }
        $id = Yii::$app->request->get('id');
        return $this->response(BannerBusiness::changeActive($id));
    }

    /**
     * Xóa banner theo id truyền vào
     */
    public function actionRemove() {
        if (is_object($resp = $this->can("remove"))) {
            return $this->response($resp);
        }
        $id = Yii::$app->request->get('id');
        return $this->response(BannerBusiness::remove($id));
    }

    /**
     * Xóa banner theo id truyền vào
     */
    public function actionAdd() {
        if (is_object($resp = $this->can("add"))) {
            return $this->response($resp);
        }
        $form = new BannerForm();
        $form->setAttributes(Yii::$app->request->getBodyParams());
        return $this->response($form->save());
    }

    /**
     * Get Banner
     */
    public function actionGet() {
        if (is_object($resp = $this->can("get"))) {
            return $this->response($resp);
        }
        $id = Yii::$app->request->get('id');
        return $this->response(new Response(true, "Lấy dữ liệu thành công", BannerBusiness::get($id)));
    }
    
}
