<?php

namespace common\models\business;

use common\models\db\Partners;
use common\models\enu\ImageType;
use common\models\inter\InterBusiness;
use common\models\output\Response;

class PartnersBusiness implements InterBusiness {

    /**
     * Menu
     * @param type $id
     * @return type
     */
    public static function get($id) {
        return Partners::findOne($id);
    }

    public static function getAll($limit = '', $active = 0, $home = 0) {
        $partners = Partners::find()->orderBy("position ASC");
        if (!empty($limit)) {
            $partners->limit($limit);
        }
        if ($active > 0) {
            $partners->andWhere(['=', 'active', $active == 1 ? 1 : 0]);
        }
        if ($home > 0) {
            $partners->andWhere(['=', 'home', $home == 1 ? 1 : 0]);
        }
        $partners=$partners->all();
        $ids = [];
        foreach ($partners as $item) {
            $ids[] = $item->id;
        }
        $images = ImageBusiness::getByTarget($ids, ImageType::PARTNERS, true, true);
        foreach ($partners as $item) {
            $item->images = isset($images[$item->id]) ? $images[$item->id] : [];
        }
        return $partners;
    }

    /**
     * mget
     * @param type $ids
     * @return type
     */
    public static function mGet($ids) {
        return Partners::find()->andWhere(["id" => $ids]);
    }

    /**
     * Thay đổi trạng thái partners
     * @param type $id
     */
    public static function changeActive($id) {
        $partners = self::get($id);
        if ($partners == null) {
            return new Response(false, "Partners không tồn tại");
        }
        $partners->active = $partners->active == 1 ? 0 : 1;
        $partners->save(false);
        return new Response(true, "Partners " . $partners->name . $partners->active ? "đã mở khóa" : "đã khóa", $partners);
    }

    public static function changeHome($id) {
        $partners = self::get($id);
        if ($partners == null) {
            return new Response(false, "Partners không tồn tại");
        }
        $partners->home = $partners->home == 1 ? 0 : 1;
        $partners->save(false);
        return new Response(true, "Partners " . $partners->name . $partners->active ? "đã hiển thị" : "đã khóa", $partners);
    }

    /**
     * Change position Partners theo id
     * @param type $id
     */
    public static function changePosition($id, $position) {
        $partners = self::get($id);
        if ($partners == null) {
            return new Response(false, "Partners không tồn tại");
        }
        $partners->position = $position;
        if (!$partners->save(false)) {
            return new Response(false, "Thay đổi trạng thái hiển thị không thành công", $partners->errors);
        }
        return new Response(true, "Thay đổi trạng thái hiển thị thành công", $partners);
    }

    /**
     * Xóa Partners theo id
     * @param type $id
     */
    public static function remove($id) {
        $partners = self::get($id);
        if ($partners == null) {
            return new Response(false, "Partners không tồn tại");
        }
        ImageBusiness::deleteByTarget($partners->id);
        $partners->delete();
        return new Response(true, "Xóa partners thành công");
    }

}
