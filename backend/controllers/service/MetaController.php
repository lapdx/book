<?php

namespace backend\controllers\service;

use backend\models\MetaForm;
use common\models\business\MetaBusiness;
use common\models\db\Meta;
use common\models\output\Response;
use Yii;

class MetaController extends ServiceController {

    public function init() {
        parent::init();
        $this->controller = Meta::getTableSchema()->name;
    }

    /**
     * Get Banner
     */
    public function actionGet() {
        if (is_object($resp = $this->can("get"))) {
            return $this->response($resp);
        }
        $type = Yii::$app->request->get('type');
        $objectId = Yii::$app->request->get('objectId');
        return $this->response(new Response(true, "Lấy dữ liệu thành công", MetaBusiness::getByObj($type,$objectId)));
    }
    /**
     * Get Banner
     */
    public function actionSave() {
        if (is_object($resp = $this->can("save"))) {
            return $this->response($resp);
        }
         $form = new MetaForm();
        $form->setAttributes(Yii::$app->request->getBodyParams());
        return $this->response($form->save());
    }

}
