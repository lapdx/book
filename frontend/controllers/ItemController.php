<?php

namespace frontend\controllers;

use common\models\business\CategoryBusiness;
use common\models\business\ItemBusiness;
use common\models\business\MetaBusiness;
use common\models\enu\MetaType;
use common\models\input\ItemSearch;
use common\util\UrlUtils;
use Yii;

class ItemController extends BaseController {

    public function actionIndex() {
        $search = new ItemSearch();
        $search->setAttributes(Yii::$app->request->get());
        if (empty($search->pageSize)) {
            $search->pageSize = 12;
        }

        if (empty($search->page)) {
            $search->page = 1;
        }
        $search->active = 1;
        $alias = Yii::$app->request->get('alias');
        $orderby = Yii::$app->request->get('orderby');
        $categories = CategoryBusiness::getAll(1);
        $cat = null;
        foreach ($categories as $c) {
            if ($c->alias == $alias) {
                $cat = $c;
                break;
            }
        }
        $cateIds = [];
        $cateIds[] = $cat->id;
        foreach ($categories as $c) {
            if ($c->parentId == $cat->id) {
                $cateIds[] = $c->id;
            }
        }
        $search->categoryIds = $cateIds;
        if (!empty($orderby)) {
            $search->sort = $orderby;
        }
        $dataPage = $search->search(true);
        $this->var['browse'] = 1;
        $this->var['item'] = 1;
        $meta = MetaBusiness::getByObj(MetaType::CATEGORY, $cat->id);
        if (!empty($meta)) {
            $this->meta($meta->title, $meta->description, $this->baseUrl.UrlUtils::browse($alias), isset($cat->images[0]) ? $cat->images[0] : $this->baseUrl.'data/bep-tu-giovani-g-252t.jpg', $meta->keyword);
        }
        return $this->render("browse", [
                    'dataPage' => $dataPage,
                    'category' => $cat,
                    'orderby' => $orderby,
        ]);
    }

    public function actionDetail() {
        $id = \Yii::$app->request->get('id');
        $item = ItemBusiness::getWithImage($id);
        $search = new ItemSearch();
        $search->setAttributes(Yii::$app->request->get());
        $search->pageSize = 7;
        $search->categoryId = $item->categoryId;
        $search->page = 1;
        $search->active = 1;
        $items = $search->search(true)->data;
        $this->var['item'] = 1;
        $meta = MetaBusiness::getByObj(MetaType::ITEM, $item->id);
        if (!empty($meta)) {
            $this->meta($meta->title, $meta->description, $this->baseUrl.UrlUtils::item($item->name, $item->id), isset($item->images[0]) ? $item->images[0] : '', $meta->keyword);
        }
        return $this->render("detail", [
                    'items' => $items,
                    'detail' => $item
        ]);
    }

    public function actionCategory() {
        $category = CategoryBusiness::getAll(true);
        $this->var['item'] = 1;
        return $this->render('category.php', [
                    'category' => $category,
        ]);
    }

}
