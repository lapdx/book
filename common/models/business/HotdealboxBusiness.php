<?php

namespace common\models\business;

use common\models\db\Hotdealbox;
use common\models\enu\ItemType;
use common\models\output\Response;

class HotdealboxBusiness {

    /**
     * Chi tiết 1 sp nổi bật
     * @param type $id
     */
    public static function get($id) {
        return Hotdealbox::findOne($id);
    }

    /**
     * Lấy toàn bộ sp nổi bật
     * @param type $id
     */
    public static function getAll() {
        return Hotdealbox::find()->all();
    }

    /**
     * Lấy theo id sản phẩm
     * @param type $itemId
     * @return type
     */
    public static function getByItemId($itemId) {
        return Hotdealbox::findAll(['itemId' => $itemId, 'active' => 1]);
    }

    /**
     * Lấy tất cả theo active
     * @param type $active
     * @return type
     */
    public static function getbyActive($active = 0) {
        $hotdealbox = Hotdealbox::findAll(['active' => $active]);
        $ids = [];
        foreach ($hotdealbox as $hot) {
            $ids[] = $hot->itemId;
        }
        $items = ItemBusiness::mGet($ids);
        foreach ($hotdealbox as $hot) {
            foreach ($items as $item) {
                if ($hot->itemId == $item->id) {
                    $hot->item = $item;
                }
            }
        }
        return $hotdealbox;
    }
    /**
     * Lấy tất cả theo active
     * @param type $active
     * @return type
     */
    public static function getbyType($type) {
        $hotdealbox = Hotdealbox::findAll(['active' => 1,'type'=>$type]);
        $ids = [];
        foreach ($hotdealbox as $hot) {
            $ids[] = $hot->itemId;
        }
        $items = ItemBusiness::mGet($ids);
        foreach ($hotdealbox as $hot) {
            foreach ($items as $item) {
                if ($hot->itemId == $item->id) {
                    $hot->item = $item;
                }
            }
        }
        return $hotdealbox;
    }

    /**
     * Thay đổi trạng thái banner
     * @param type $id
     */
    public static function changeActive($id) {
        $hotdealbox = self::get($id);
        if ($hotdealbox == null) {
            return new Response(false, "Sản phẩm không tồn tại trên hệ thống");
        }
        $hotdealbox->active = $hotdealbox->active == 1 ? 0 : 1;
        $hotdealbox->save(false);
        return new Response(true, "Thành công", $hotdealbox);
    }
    /**
     * Thay đổi trạng thái banner
     * @param type $id
     */
    public static function changeType($id) {
        $hotdealbox = self::get($id);
        if ($hotdealbox == null) {
            return new Response(false, "Sản phẩm không tồn tại trên hệ thống");
        }
        $hotdealbox->type = $hotdealbox->type== ItemType::HOT ? ItemType::SELLING : ItemType::HOT;
        $hotdealbox->save(false);
        return new Response(true, "Thành công", $hotdealbox);
    }

    /**
     * Xóa banner theo id
     * @param type $id
     */
    public static function remove($id) {
        $hotdealbox = self::get($id);
        if ($hotdealbox == null) {
            return new Response(false, "Sản phẩm không tồn tại trên hệ thống");
        }
        $hotdealbox->delete();
        return new Response(true, "Xóa sản phẩm nổi bật thành công");
    }

}
