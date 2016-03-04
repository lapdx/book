<?php

namespace frontend\controllers;

use common\models\business\MetaBusiness;
use common\models\business\NewsBusiness;
use common\models\business\NewsCategoryBusiness;
use common\models\enu\MetaType;
use common\models\input\NewsSearch;
use common\util\UrlUtils;
use Yii;

class NewsController extends BaseController {

    public function actionIndex() {
        $search = new NewsSearch();
        $search->setAttributes(Yii::$app->request->get());
        if ($search->pageSize == "" || $search->pageSize == null) {
            $search->pageSize = 10;
        }
        if ($search->page == "" || $search->page == null) {
            $search->page = 1;
        }
        $search->active = 1;
        $dataPage = $search->search(true);
        $this->var['new'] = 1;
        $this->var['flag'] = 1;

        return $this->render("index", [
                    'dataPage' => $dataPage,
        ]);
    }

    public function actionDetail() {
        $alias = Yii::$app->request->get('alias');
        $detail = NewsBusiness::getByAlias($alias);
        if (empty($detail)) {
            return $this->render('//error/message', ['message' => "Tin tức không tồn tại", 'title' => "404 NOT FOUND"]);
        }
        $detail->viewCount = $detail->viewCount + 1;
        $detail->save(false);
        $news = NewsBusiness::getAll(5, 1);
        $this->var['new'] = 1;
        $this->var['flag'] = 1;
        $meta = MetaBusiness::getByObj(MetaType::NEWS, $detail->id);
        if (!empty($meta)) {
            $this->meta($meta->title, $meta->description, $this->baseUrl.UrlUtils::news($alias), isset($detail->images[0]) ? $detail->images[0] : '', $meta->keyword);
        }
        return $this->render("detail", [
                    'detail' => $detail,
                    'newss' => $news,
        ]);
    }

    public function actionBrowse() {
        $search = new NewsSearch();
        $alias = Yii::$app->request->get('alias');
        $category = NewsCategoryBusiness::getAll(true);
        $catealias = null;
        foreach ($category as $value) {
            if ($value->alias == $alias) {
                $catealias = $value;
                break;
            }
        }
        $cateIds = [];
        $cateIds[] = $catealias->id;
        foreach ($category as $cat) {
            if ($cat->parentId == $catealias->id) {
                $cateIds[] = $cat->id;
            }
        }
        $search->categoryIds = $cateIds;
        $search->active = 1;
        $cateByParentId = [];
        foreach ($category as $value) {
            if ($value->parentId == $catealias->id) {
                array_push($cateByParentId, $value);
            }
        }
        if (sizeof($cateByParentId) == 0) {
            foreach ($category as $value) {
                if ($value->parentId == $catealias->parentId) {
                    array_push($cateByParentId, $value);
                }
            }
        }
        $search->setAttributes(Yii::$app->request->get());

        if ($search->pageSize == "" || $search->pageSize == null) {
            $search->pageSize = 10;
        }

        if ($search->page == "" || $search->page == null) {
            $search->page = 1;
        }

        $search->active = 1;

        $dataPage = $search->search(true);
        $this->var['flag'] = 1;
        $meta = MetaBusiness::getByObj(MetaType::NEWSCATEGORY, $catealias->id);
        if (!empty($meta)) {
            $this->meta($meta->title, $meta->description, $this->baseUrl.UrlUtils::newsBrowse($alias),$this->baseUrl . 'data/bep-tu-giovani-g-252t.jpg', $meta->keyword);
        }
        return $this->render("index", [
                    'dataPage' => $dataPage,
        ]);
    }

}
