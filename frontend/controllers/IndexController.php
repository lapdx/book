<?php

namespace frontend\controllers;

use common\models\business\BannerBusiness;
use common\models\business\HotdealboxBusiness;
use common\models\business\MetaBusiness;
use common\models\enu\BannerType;
use common\models\enu\ItemType;
use common\models\enu\MetaType;
use common\models\input\ItemSearch;
use common\models\db\Category;
use common\models\db\Item;
use common\models\db\Hotdealbox;
use Yii;

class IndexController extends BaseController {

    /**
     * Trang chủ backend
     * @return type
     */
    //Trang chủ
    public function actionIndex() {
        $categories     = Category::findAll(['parentId'=>0]);
        $new_items      = Item::find()->where('active = 1')->orderBy('createTime DESC')->limit(10)->all();
        $sale_items     = Item::find()->where('sellPrice != startPrice AND active = 1')->limit(10)->all();
        return $this->render('index', [
            'categories' => $categories,
            'new_items'  => $new_items,
            'sale_items' => $sale_items,
            ]);
    }

    //Trang giỏ hàng
    public function actionCart(){
        $cart = array('item'=>array(),'bill'=>0);
        if(isset(Yii::$app->session['cart'])){
            foreach (Yii::$app->session['cart'] as $key => $value){
                $item = Item::findOne(['id'=>$key]);
                $cart['item'][] = array('item'=>$item,'quantity'=>$value);
                $cart['bill'] += Item::getSellPrice($key)*$value;
            }
        }
        return $this->render('cart', [
            'cart' => $cart,
            ]);
    }
    //Trang liên hệ
    public function actionContact(){
        return $this->render('contact');
    }
    //Trang giới thiệu
    public function actionIntro(){
        return $this->render('intro');
    }
    //Trang hủy giỏ hàng
    public function actionRemove_cart(){
        unset(Yii::$app->session['cart']);
        $this->redirect(array('/index/cart'));
    }
    //Trang hủy item trong giỏ hàng
    public function actionRemove_item(){
        $id  = Yii::$app->request->get('id');
        $cart = Yii::$app->session['cart'];
        unset($cart[$id]);
        Yii::$app->session['cart'] = $cart;
        $this->redirect(array('/index/cart'));
    }
    //Trang thanh toán
    public function actionPayment(){
        return $this->render('payment', [
            // 'categories' => $categories,
            // 'new_items'  => $new_items,
            // 'sale_items' => $sale_items,
            ]);
    }
    public function actionSearch() {
        // $keyword = Yii::$app->request->get('keyword');
        // $search = new ItemSearch();
        // $search->setAttributes(Yii::$app->request->get());
        // $search->keyword = $keyword;
        // $search->pageSize = 12;
        // $dataPage = $search->search(true);
        // $meta = MetaBusiness::getByObj(MetaType::INDEX, 1);
        // if (!empty($meta)) {
        //     $this->meta($meta->title, $meta->description, $this->baseUrl, isset($this->var['home']->logo[0]) ? $this->var['home']->logo[0] : '', $meta->keyword);
        // }
        // return $this->render('search', [
        //     'dataPage' => $dataPage,
        //     ]);
    }

    public function actionPhp() {
        phpinfo();
    }
    public function actionTest(){
        $hotdealbox = Hotdealbox::findOne(['type'=>'selling']);
    }

}
