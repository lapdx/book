<?php

namespace common\models\business;

use common\models\db\OrderInfo;
use common\models\db\OrderItem;
use common\models\inter\InterBusiness;
use common\models\output\Response;
use Yii;

class OrderBusiness implements InterBusiness {

    /**
     * 
     * @param type $id
     * @return type
     */
    public static function get($id) {
        $order = self::getInfor($id);
        if (!empty($order)) {
            $order->items = self::getItems($order->id);
        }
        return $order;
    }

    /**
     * 
     * @param type $id
     * @return type
     */
    public static function getInfor($id) {
        return OrderInfo::findOne($id);
    }

    public static function getItems($orderId) {
        return OrderItem::findAll(['orderId' => $orderId]);
    }

    public static function mGet($ids) {
        
    }

    public static function remove($id) {
        $order = self::getInfor($id);
        if (empty($order)) {
            return new Response(false, "Không tồn tại đơn hàng trên hệ thống", []);
        }
        $order->remove = 1;
        $order->updateTime = time();
        if (!$order->save(false)) {
            return new Response(false, "Không xóa đc", $order->errors);
        }
        return new Response(true, "Xóa đơn hàng thành công", $order);
    }

    /**
     * Lấy đơn hàng hiện tại trong giỏ hàng
     * @param type $cart
     * @return type
     */
    public static function getCart($cart = null) {
        if ($cart != null && is_object($cart)) {
            Yii::$app->getSession()->set("cart", $cart);
        }
        $cart = Yii::$app->getSession()->get("cart");
        if (!isset($cart->items) || empty($cart->items))
            Yii::$app->getSession()->set('cart', null);
        return Yii::$app->getSession()->get("cart");
    }

    /**
     * Xóa giỏ hàng
     * @param 
     * @return type
     */
    public static function removeCarts() {
        Yii::$app->getSession()->set('cart', null);
        return new Response(true, "Xoá giỏ hàng thành công");
    }

    /**
     * Xóa sản phẩm khỏi cart
     * @param type $itemId
     * @return type
     */
    public static function removeFromCart($itemId) {
        $cart = self::getCart();
        if ($cart == null) {
            return new Response(true, "", self::getCart($cart));
        }
        if ($cart->items == null || empty($cart->items)) {
            $cart->items = [];
        }
        $items = [];
        foreach ($cart->items as $key => $orderItem) {
            if ($orderItem->sku != $itemId && isset($cart->items[$key])) {
//                unset($cart->items[$key]);
//                break;
                $items[] = $cart->items[$key];
            }
        }
//        $cart->items = array_merge([], $cart->items);
        $cart->items = $items;
        return new Response(true, "", self::getCart($cart));
    }

    /**
     * Cập nhật số lượng sản phẩm
     * @param type $itemId
     * @param type $quantity
     * @return type
     */
    public static function updateCart($itemId, $quantity) {
        $cart = self::getCart();
        if ($cart == null || $quantity <= 0) {
            return new Response(false, "Số lượng phải lớn hơn 0", self::getCart());
        }
        if ($cart->items == null || empty($cart->items)) {
            $cart->items = [];
        }
        foreach ($cart->items as $orderItem) {
            if ($orderItem->sku == $itemId) {
                $orderItem->quantity = $quantity;
                break;
            }
        }
        return new Response(true, "", self::getCart($cart));
    }

    public static function addToCart($itemId, $quantity) {
        $item = ItemBusiness::getWithImage($itemId);
        if (empty($item)) {
            return new Response(false, "Sản phẩm không tồn tại trên hệ thống");
        }
        if ($quantity < 1) {
            return new Response(false, "Số lượng phải lớn hơn 0");
        }
        $cart = self::getCart();
        if (empty($cart)) {
            $cart = new OrderInfo();
        }
        $user = Yii::$app->getSession()->get("customer");
        if (!empty($user)) {
            $cart->email = $user->id;
        }
        if (empty($cart->items)) {
            $cart->items = [];
        }
        $exits = false;
        foreach ($cart->items as $orderItem) {
            if ($orderItem->sku == $item->id) {
                $exits = true;
                $orderItem->quantity += $quantity;
            }
        }
        if (!$exits) {
            $orderItem = new OrderItem();
            $orderItem->name = $item->name;
            $orderItem->sku = $item->id;
            $orderItem->startPrice = $item->startPrice;
            $orderItem->sellPrice = $item->sellPrice;
            $orderItem->quantity = $quantity;
            $orderItem->image = !empty($item->images) ? $item->images[0] : "";
            $items = [];
            $items = $cart->items;
            $items[] = $orderItem;
            $cart->items = $items;
        }
        return new Response(true, "Bạn đã thêm " . $orderItem->name . " với số lượng " . $orderItem->quantity . " vào giỏ hàng", self::getCart($cart));
    }

    public static function changeStatus($id, $status) {
        $order = self::getInfor($id);
        $order->status = $status;
        if (!$order->save(false)) {
            return new Response(false, "Không cập nhật được", $order->errors);
        }
        return new Response(true, "Thay đổi trạng thái thành công", $order);
    }

}
