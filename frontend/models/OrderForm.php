<?php

namespace frontend\models;

use common\models\business\EmailBusiness;
use common\models\business\HomeBusiness;
use common\models\business\OrderBusiness;
use common\models\db\OrderInfo;
use common\models\db\OrderItem;
use common\models\output\Response;
use Yii;
use yii\base\Model;

class OrderForm extends Model {

    public $id;
    public $name;
    public $email;
    public $address;
    public $phone;
    public $paymentMethod;
    public $note;
    public $totalPrice;

    public function rules() {
        return [
            [['name', 'email', 'address', 'phone', 'paymentMethod', 'note'], 'required', 'message' => '{attribute} không được để trống !'],
            [['totalPrice'], 'number', 'message' => '{attribute} phải là số !'],
            [['phone'], 'integer', 'message' => '{attribute} phải là số !'],
            [['name', 'email', 'address'], 'string', 'max' => 255, 'message' => '{attribute} phải là ký tự !'],
            [['paymentMethod'], 'string', 'max' => 10, 'message' => '{attribute} phải là ký tự !'],
            [['note'], 'string', 'max' => 500, 'message' => '{attribute} phải là ký tự !'],
        ];
    }

    public function attributeLabels() {
        return [
            'name' => "Tên",
            'email' => "Email",
            'note' => "Ghi chú",
            'phone' => "Số điện thoại",
            'address' => "Địa chỉ",
        ];
    }

    public function save() {
        $cart = OrderBusiness::getCart();
        if (empty($cart)) {
            return new Response(false, "Không có đơn hàng nào !", []);
        }
        if (!$this->validate()) {
            return new Response(false, "Dữ liệu không hợp lệ", $this->errors);
        }
        $order = new OrderInfo();
        $order->name = $this->name;
        $order->address = $this->address;
        $order->email = $this->email;
        $order->note = $this->note;
        $order->phone = $this->phone;
        $order->paymentMethod = $this->paymentMethod;
        $order->createTime = time();
        $order->updateTime = time();
        $order->buyerId = empty(Yii::$app->getSession()->get("customer")) ? $this->email : Yii::$app->getSession()->get("customer")->id;
        if (!$order->save(false)) {
            return new Response(false, "Không lưu được vào csdl", $order->errors);
        }
        $total = 0;
        foreach ($cart->items as $item) {
            $total += $item->sellPrice * $item->quantity;
            $orderItem = new OrderItem();
            $orderItem->setAttributes($item->getAttributes());
            $orderItem->orderId = $order->id;
            if (!$orderItem->save()) {
                return new Response(false, "Không lưu được sản phẩm vào csdl", $orderItem->errors);
            }
        }
        $order->totalPrice = $total;
        if (!$order->save(false)) {
            return new Response(false, "Không cập nhật đc vào csdl", $order->errors);
        }
        $order->items = $cart->items;
        EmailBusiness::send($this->email,'[Hoa Lửa] Thông báo đặt hàng thành công',"order",['order' => $order]);
        $home = HomeBusiness::get(1);
        EmailBusiness::send($home->email,'[Hoa Lửa] Thông báo đặt hàng thành công',"order",['order' => $order]);
        OrderBusiness::removeCarts();
        return new Response(true, "Đặt hàng thành công! Chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất !", $order);
    }

}
