<?php

namespace frontend\controllers;

use common\models\db\Category;
use common\models\db\Item;
use common\models\db\Hotdealbox;
use Yii;


class ItemController extends BaseController {

    public $enableCsrfValidation = false;

    public function actionSearch() {
        $id         = Yii::$app->request->get('id');
        $page      = Yii::$app->request->get('page',1);
        $key      = Yii::$app->request->get('k','');

        $query = 'SELECT * FROM item where name LIKE "%'.$key.'%" OR description LIKE "%'.$key.'%" OR content LIKE "%'.$key.'%"';
        $items = Item::findBySql($query)->limit(6)->all();
        $total_count = count($items); 
        $total_page = ceil(count($items)/6);
        $items = array_slice($items,6*($page-1),6);
        $count = count($items);
        $categories = Category::findAll(['parentId'=>0]);
        $selling    = Hotdealbox::getSelling();
        return $this->render('search.php', [
            'categories' => $categories,
            'selling'   => $selling,
            'items'     => $items,
            'total'     => $total_page,
            'current'   => $page,
            'keyword'   => $key,
            'count'     =>$count,
            'total_count'     =>$total_count
            ]);
    }

    public function actionDetail() {
        $id     = Yii::$app->request->get('id');
        $item   = Item::findOne(['id'=>$id]);
        $selling    = Hotdealbox::getSelling();
        return $this->render("detail", [
            'item' => $item,
            'selling' => $selling
            ]);
    }

    public function actionCategory() {
        $id         = Yii::$app->request->get('id');
        $page       = Yii::$app->request->get('page',1);
        $category   = Category::findOne(['id'=>$id]);
        $items      = $category->getAllItem();
        $total_page = ceil(count($items)/6);
        $items = array_slice($items,6*($page-1),6);
        $categories = Category::findAll(['parentId'=>0]);
        $selling    = Hotdealbox::getSelling();
        return $this->render('category.php', [
            'main_category' => $category,
            'categories' => $categories,
            'selling'   => $selling,
            'items'     => $items,
            'total'     => $total_page,
            'current'   => $page
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
        $session['bill']    = $data['bill'];
        $session['cart']    = $cart;
        echo json_encode($data);
    }

}
