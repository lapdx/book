<?php

namespace common\models\business;

use common\models\db\Banner;
use common\models\enu\BannerType;
use common\models\enu\ImageType;
use common\models\output\Response;

class BannerBusiness {

    /**
     * Chi tiết 1 banner
     * @param type $id
     */
    public static function get($id) {
        return Banner::findOne($id);
    }

    /**
     * Thay đổi trạng thái banner
     * @param type $id
     */
    public static function changeActive($id) {
        $banner = self::get($id);
        if ($banner == null) {
            return new Response(false, "Banner không tồn tại trên hệ thống");
        }
        $banner->active = $banner->active == 1 ? 0 : 1;
        $banner->save(false);
        return new Response(true, "Banner " . $banner->name . $banner->active ? "đã mở khóa" : "đã khóa", $banner);
    }

    /**
     * Xóa banner theo id
     * @param type $id
     */
    public static function remove($id) {
        $banner = self::get($id);
        if ($banner == null) {
            return new Response(false, "Banner không tồn tại trên hệ thống");
        }
        ImageBusiness::deleteByTarget($banner->id);
        $banner->delete();
        return new Response(true, "Xóa banner thành công");
    }

    public static function getByTypeId($type, $id) {

        $banners = Banner::findAll(['type' => $type, 'objectId' => $id]);
        $ids = [];
        foreach ($banners as $banner) {
            $ids[] = $banner->id;
        }
        $images = ImageBusiness::getByTarget($ids, ImageType::BANNER, true, []);
        foreach ($banners as $banner) {
            $banner->images = isset($images[$banner->id]) ? $images[$banner->id] : "";
        }
        return $banners;
    }

    /**
     * Lấy những banner đang hoạt động
     * @param type $type
     * @param type $w_thum
     * @param type $h_thum
     * @return type
     */
    public static function getByType($type, $active = 0) {
        $query = Banner::find();
        $query->andWhere(["type" => $type]);
        $query->andWhere(["active" => $active]);
        $query->orderBy("position asc");
        $banners = $query->all();
        $ids = [];
        foreach ($banners as $banner) {
            $ids[] = $banner->id;
        }
        $images = ImageBusiness::getByTarget($ids, ImageType::BANNER, true,true);
        foreach ($banners as $banner) {
            $banner->images = isset($images[$banner->id]) ? $images[$banner->id] : "";
        }
        return $banners;
    }

}
