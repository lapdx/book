<?php

namespace backend\controllers\service;

use backend\models\ContactForm;
use common\models\business\BannerBusiness;
use common\models\business\ContactBusiness;
use common\models\db\Contact;
use common\models\input\ContactSearch;
use common\models\output\Response;
use Yii;

class ContactController extends ServiceController {

    public function init() {
        parent::init();
        $this->controller = Contact::getTableSchema()->name;
    }

    /**
     * Danh sách banner
     */
    public function actionGrid() {
        if (is_object($resp = $this->can("grid"))) {
            return $this->response($resp);
        }
        $search = new ContactSearch();
        $search->setAttributes(Yii::$app->request->get());
        return $this->response(new Response(true, "Lấy dữ liệu thành công", $search->search(true)));
    }

    /**
     * Xóa banner theo id truyền vào
     */
    public function actionRemove() {
        if (is_object($resp = $this->can("remove"))) {
            return $this->response($resp);
        }
        $id = Yii::$app->request->get('id');
        return $this->response(ContactBusiness::remove($id));
    }

    /**
     * sửa xóa
     */
    public function actionChange() {
        if (is_object($resp = $this->can("change"))) {
            return $this->response($resp);
        }
        $form = new ContactForm();
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
        return $this->response(new Response(true, "Lấy dữ liệu thành công", ContactBusiness::get($id)));
    }

}
