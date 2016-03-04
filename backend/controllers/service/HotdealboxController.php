<?php

namespace backend\controllers\service;

use backend\models\HotdealboxForm;
use common\models\business\HotdealboxBusiness;
use common\models\business\ItemBusiness;
use common\models\db\Hotdealbox;
use common\models\output\Response;
use Yii;

class HotdealboxController extends ServiceController {

    public function init() {
        parent::init();
        $this->controller = Hotdealbox::getTableSchema()->name;
    }

    /**
     * Danh sách sản phẩm nổi bật
     * @return type
     */
    public function actionGrid() {
        if (is_object($resp = $this->can("grid"))) {
            return $this->response($resp);
        }
        $hotdealbox = HotdealboxBusiness::getAll();
        $ids = [];
        foreach ($hotdealbox as $hot) {
            $ids[] = $hot->itemId;
        }
        $items = ItemBusiness::mGet($ids);
        foreach ($hotdealbox as $hot) {
            foreach ($items as $item) {
                if ($hot->itemId == $item->id) {
                    $hot->item = $item;
                }
            }
        }
//        print_r($hotdealbox);die;
        return $this->response(new Response(true, "Lấy dữ liệu thành công", $hotdealbox));
    }

    /**
     * Thêm and sửa sp nổi bật
     * @return type
     */
    public function actionSave() {
        if (is_object($resp = $this->can("save"))) {
            return $this->response($resp);
        }
        $form = new HotdealboxForm();
        $form->setAttributes(Yii::$app->request->getBodyParams());
        return $this->response($form->save());
    }

    /**
     * Thay đổi trạng thái
     * @return type
     */
    public function actionChangeactive() {
        if (is_object($resp = $this->can("changeactive"))) {
            return $this->response($resp);
        }
        $id = \Yii::$app->request->get("id");
        return HotdealboxBusiness::changeActive($id);
    }
    /**
     * Thay đổi trạng thái
     * @return type
     */
    public function actionChangetype() {
        if (is_object($resp = $this->can("changetype"))) {
            return $this->response($resp);
        }
        $id = \Yii::$app->request->get("id");
        return HotdealboxBusiness::changeType($id);
    }

    /**
     * Xóa
     * @return type
     */
    public function actionRemove() {
        if (is_object($resp = $this->can("remove"))) {
            return $this->response($resp);
        }
        $id = \Yii::$app->request->get("id");
        return HotdealboxBusiness::remove($id);
    }

}
