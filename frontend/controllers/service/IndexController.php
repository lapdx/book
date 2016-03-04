<?php

namespace frontend\controllers\service;

use common\models\input\NewsSearch;
use common\models\output\Response;
use Yii;

class IndexController extends ServiceController {

    public function actionGet() {
        $id = Yii::$app->request->get('id');
        $app = new NewsSearch();
        $app->active = 1;
        $app->nav = 1;
        $app->categoryIds = $id;
        $app->pageSize = 10;
        return $this->response(new Response(true, "Lấy dữ liệu thành công", $app->search(true)->data));
    }

}
