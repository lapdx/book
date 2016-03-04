<?php

namespace backend\controllers\service;

use backend\models\UploadForm;
use common\models\business\ImageBusiness;
use common\models\db\Image;
use common\models\input\ImageSearch;
use common\models\output\Response;
use Yii;
use yii\web\UploadedFile;

class ImageController extends ServiceController {

    public function init() {
        parent::init();
        $this->controller = Image::getTableSchema()->name;
    }

    /**
     * 
     * @return type
     */
    public function actionGrid() {
        if (is_object($resp = $this->can("grid"))) {
            return $this->response($resp);
        }

        $image = new ImageSearch();
        $image->setAttributes(\Yii::$app->request->get());
        return $this->response(new Response(true, "List Images", $image->search(true)));
    }

    /**
     * 
     * @return type
     */
    public function actionAdd() {
        if (is_object($resp = $this->can("add"))) {
            return $this->response($resp);
        }
        $targetId = strval(Yii::$app->request->get('target'));
        $type = Yii::$app->request->get('type');
        $form = new UploadForm();
        $form->setAttributes(Yii::$app->request->post());
        $form->imageFile = UploadedFile::getInstanceByName('imageFile');
        if (!empty($form->imageFile)) {
            return $this->response(ImageBusiness::upload($form->imageFile, $type, $targetId));
        }
        return $this->response(ImageBusiness::dowload($form->url, $type, $targetId));
    }

    /**
     * 
     * @return type
     */
    public function actionGetbytarget() {
        if (is_object($resp = $this->can("getbytarget"))) {
            return $this->response($resp);
        }
        $targetId = json_decode(Yii::$app->request->get('target'));
        if ($targetId == null)
            $targetId = trim(Yii::$app->request->get('target'));
        $type = Yii::$app->request->get('type');
        $url = Yii::$app->request->get('url');
        $image = ImageBusiness::getByTarget($targetId, $type, $url == true);
        return $this->response(new Response(true, "Image", $image));
    }

    /**
     * 
     * @return type
     */
    public function actionRemove() {
        if (is_object($resp = $this->can("remove"))) {
            return $this->response($resp);
        }
        $id = Yii::$app->request->get('id');
        ImageBusiness::deleteByImageId(["id" => $id]);
        return $this->response(new Response(true, "Image has been deleted from the system"));
    }

}
