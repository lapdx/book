<?php

namespace frontend\controllers;

use common\models\db\Category;
use common\models\db\Item;
use common\models\db\Hotdealbox;
use common\models\db\OrderInfo;
use common\models\db\OrderItem;
use Yii;

class IndexController extends BaseController {

    /**
     * Trang chủ backend
     * @return type
     */
    public $enableCsrfValidation = false;
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
        $request = Yii::$app->request;
        $cart = array('item'=>array(),'bill'=>0);
        
        // var_dump(Yii::$app->mailer->transport);return;
        if(isset(Yii::$app->session['cart']) && !empty(Yii::$app->session['cart'])){
            foreach (Yii::$app->session['cart'] as $key => $value){
                $item = Item::findOne(['id'=>$key]);
                $cart['item'][] = array('item'=>$item,'quantity'=>$value);
                $cart['bill'] += Item::getSellPrice($key)*$value;
            }
        }else Yii::$app->session->setFlash('danger','Không có sản phẩm nào trong giỏ hàng');
        if ($request->isPost) {
            if(!Yii::$app->session->hasFlash('danger')){
                $db = Yii::$app->db;
                $transaction = $db->beginTransaction();

                try {
                    $session_cart = Yii::$app->session['cart'];
                    $order = new OrderInfo();
                    $order->email           = $request->post('email','');
                    $order->name            = $request->post('name','');
                    $order->phone           = $request->post('phone','');
                    $order->address         = $request->post('address','');
                    $order->paymentMethod   = $request->post('method','');
                    $order->note            = $request->post('note','');
                    $order->totalPrice      = $cart['bill'];
                    if(Yii::$app->user->isGuest) $order->buyerId = Yii::$app->user->identity->id;
                    else $order->buyerId         = $request->post('email','');
                    $order->createTime      = time();
                    $order->updateTime      = time();
                    $order->status          = OrderInfo::STATUS_UNPAID;
                    if(!$order->save()){
                        Yii::$app->session->setFlash('danger','Đã có lỗi xảy ra');
                        return $this->render('payment', [
                            'cart' => $cart,
                            ]);
                    }else{
                        $content = "Xin chào <b>$order->name</b>, chúc mừng bạn đã đặt hàng thành công qua hệ thống BookStore. Đơn hàng của bạn bao gồm:<br><br>";
                        foreach ($cart['item'] as $item) {
                            $order_item = new OrderItem();
                            $order_item->orderId    = $order->id;
                            $order_item->startPrice = $item['item']->startPrice;
                            $order_item->sellPrice  = $item['item']->sellPrice;
                            $order_item->name       = $item['item']->name;
                            $order_item->quantity   = $item['quantity'];
                            $order_item->image      = $item['item']->getThumbnailImageUrl();
                            $order_item->sku        = 0;
                            if(!$order_item->save()){
                                Yii::$app->session->setFlash('danger','Đã có lỗi xảy ra');
                                return $this->render('payment', [
                                    'cart' => $cart,
                                    ]);
                            }
                            $content .= '<li><b>'.$item['item']->name.'</b> x <b>'.$item['quantity'].'</b></li>';
                        }
                        $content .= '<br>Tổng giá trị đơn hàng của bạn là: <b>'.number_format($item['quantity']*$item['item']->sellPrice,0,',','.').'đ</b><br>Chúng tôi sẽ liên lạc lại với bạn trong thời gian sớm nhất để giao hàng';
                        Yii::$app->mailer->compose()
                        ->setFrom('trunglbdz1@gmail.com')
                        ->setTo('trunglbict@gmail.com')
                        ->setSubject('[BookStore] Đặt hàng thành công')
                        ->setHtmlBody($content)
                        ->send();
                        Yii::$app->session->setFlash('success','<b>Chúc mừng!</b> Đơn hàng đã được đặt thành công, chúng tôi sẽ sớm liên lạc với bạn');
                        unset(Yii::$app->session['cart']);
                        $transaction->commit();
                    }
                } catch(\Exception $e) {

                    $transaction->rollBack();

                    throw $e;
                }
            }           
        }
        
        return $this->render('payment', [
            'cart' => $cart,
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
        
    }

}
