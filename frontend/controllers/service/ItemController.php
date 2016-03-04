<?php

namespace frontend\controllers\service;

use common\models\business\CategoryBusiness;
use common\models\input\ItemSearch;
use common\models\output\Response;
use Yii;

class ItemController extends ServiceController {

    public function actionFilter() {
        $partnersIds = Yii::$app->request->get('partnersId');
        $categoryId = Yii::$app->request->get('categoryId');
        $powers = Yii::$app->request->get('power');
        $prices = Yii::$app->request->get('price');
        $origins = Yii::$app->request->get('origin');
        $types = Yii::$app->request->get('type');
        $noises = Yii::$app->request->get('noise');
        $search = new ItemSearch();
        $search->partnersIds = $partnersIds;
        $search->powers = $powers;
        $search->noises = $noises;
        $search->prices = $prices;
        $search->types = $types;
        $search->origins = $origins;
        $search->active = 1;
        $categories = CategoryBusiness::getAll(1);
        $cateIds = [];
        $cateIds[] = $categoryId;
        foreach ($categories as $c) {
            if ($c->parentId == $categoryId) {
                $cateIds[] = $c->id;
            }
        }
        $search->categoryIds = $cateIds;
        $search->page = 1;
        $search->pageSize = PHP_INT_MAX;
        return $this->response(new Response(true, "Lấy dữ liệu thành công",$search->search(true)->data));
    }

}
