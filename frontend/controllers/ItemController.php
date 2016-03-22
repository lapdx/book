<?php

namespace frontend\controllers;

use common\models\business\CategoryBusiness;
use common\models\business\ItemBusiness;
use common\models\business\MetaBusiness;
use common\models\enu\MetaType;
use common\models\input\ItemSearch;
use common\util\UrlUtils;
use common\models\db\Category;
use common\models\db\Item;
use common\models\db\Hotdealbox;
use Yii;


class ItemController extends BaseController {

    public $enableCsrfValidation = false;
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
        $id     = Yii::$app->request->get('id');
        $item   = Item::findOne(['id'=>$id]);
        return $this->render("detail", [
            'item' => $item,
            // 'best_seller' => $best_seller
            ]);
    }

    public function actionCategory() {
        $id         = Yii::$app->request->get('id');
        $category   = Category::findOne(['id'=>$id]);
        $categories = Category::findAll(['parentId'=>0]);
        $selling    = Hotdealbox::getSelling();
        return $this->render('category.php', [
            'main_category' => $category,
            'categories' => $categories,
            'selling'   => $selling
            ]);
    }
    public function actionAdd_to_cart(){
        $id         = Yii::$app->request->post('id');
        $quantity   = Yii::$app->request->post('quantity');
        $type       = Yii::$app->request->post('type');
        $session    = Yii::$app->session;
        $cart       = $session['cart'];
        if($type == 'update') $cart[$id] = $quantity;
        elseif($type == 'add'){
            if(array_key_exists($id, $cart)) $cart[$id] += $quantity;
            else $cart[$id] = $quantity;
        }
        $data['bill'] = 0;
        $data['total'] = 0;
        foreach ($cart as $key => $value) {
            $data['total'] += $value;
            $data['bill'] += Item::getSellPrice($key) * $value;
        }
        $session['total']   = $data['total'];
        $session['bill']    = number_format($data['bill'],0,',','.');
        $session['cart']    = $cart;
        echo json_encode($data);
    }

}
