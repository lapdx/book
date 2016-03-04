<?php

namespace frontend\controllers;

use common\models\business\BannerBusiness;
use common\models\business\HotdealboxBusiness;
use common\models\business\MetaBusiness;
use common\models\enu\BannerType;
use common\models\enu\ItemType;
use common\models\enu\MetaType;
use common\models\input\ItemSearch;
use Yii;

class IndexController extends BaseController {

    /**
     * Trang chủ backend
     * @return type
     */
    public function actionIndex() {
        $hot = HotdealboxBusiness::getbyType(ItemType::HOT);
        $sell = HotdealboxBusiness::getbyType(ItemType::SELLING);
        $heart = BannerBusiness::getByType(BannerType::HEART, true);
        $this->var['index'] = 1;
        $meta = MetaBusiness::getByObj(MetaType::INDEX, 1);
        if (!empty($meta)) {
            $this->meta($meta->title, $meta->description, $this->baseUrl, isset($this->var['home']->logo[0]) ? $this->var['home']->logo[0] : '', $meta->keyword);
        }
        return $this->render('index', [
                    'boxs' => $hot,
                    'sell' => $sell,
                    'heart' => $heart
        ]);
    }

    public function actionSearch() {
        $keyword = Yii::$app->request->get('keyword');
        $search = new ItemSearch();
        $search->setAttributes(Yii::$app->request->get());
        $search->keyword = $keyword;
        $search->pageSize = 12;
        $dataPage = $search->search(true);
        $meta = MetaBusiness::getByObj(MetaType::INDEX, 1);
        if (!empty($meta)) {
            $this->meta($meta->title, $meta->description, $this->baseUrl, isset($this->var['home']->logo[0]) ? $this->var['home']->logo[0] : '', $meta->keyword);
        }
        return $this->render('search', [
                    'dataPage' => $dataPage,
        ]);
    }

    public function actionPhp() {
        phpinfo();
    }

}
