<?php

namespace common\models\business;

use common\models\db\News;
use common\models\enu\ImageType;
use common\models\inter\InterBusiness;
use common\models\output\Response;

class NewsBusiness implements InterBusiness {

    /**
     * Menu
     * @param type $id
     * @return type
     */
    public static function get($id) {
        return News::findOne($id);
    }

    /**
     * mget
     * @param type $ids
     * @return type
     */
    public static function mGet($ids) {
        return News::find()->andWhere(["id" => $ids]);
    }

    /**
     * Xóa news hiện hành
     * @param type $id
     */
    public static function remove($id) {
        $news = self::get($id);
        if ($news == null) {
            return new Response(false, "Không thể thực hiện xóa một tin tức không tồn tại , vui lòng thử lại xin cảm ơn");
        }
        ImageBusiness::deleteByTarget($news->id);
        News::deleteAll(['id' => $id]);
        return new Response(true, "Xóa tin tức thành công");
    }

    /**
     * Lấy tất cả các news bằng newscateId
     * @param type $categoryId
     * @return type
     */
    public static function getByNewsCategoryId($categoryId) {
        return News::findAll(["categoryId" => $categoryId]);
    }

    /**
     * Thay đổi trạng thái news
     * @param type $id
     * @return type
     */
    public static function changeActive($id) {
        $new = News::findOne($id);
        if ($new == null) {
            return new Response(false, "Tin tức không tồn tại");
        }
        $new->active = $new->active == 1 ? 0 : 1;
        $new->save(false);
        return new Response(true, "News " . $new->name . $new->active ? "has been active" : "has been locked", $new);
    }

    /**
     * Thay đổi trạng thái news
     * @param type $id
     * @return type
     */
    public static function changeHome($id) {
        $new = News::findOne($id);
        if ($new == null) {
            return new Response(false, "Tin tức không tồn tại");
        }
        $new->home = $new->home == 1 ? 0 : 1;
        $new->save(false);
        return new Response(true, "News " . $new->name . $new->home ? "has been active" : "has been locked", $new);
    }

    /**
     * Lấy ra tất cả các bản ghi news hiện hành
     * @return type
     */
    public static function getAll($limit = '', $active = 0, $home = 0,$footer = 0) {
        $news = News::find();
        if ($limit != '' || $limit != null) {
            $news->limit($limit);
        }
        if ($active > 0) {
            $news->andWhere(['=', 'active', $active == 1 ? 1 : 0]);
        }
        if ($home > 0) {
            $news->andWhere(['=', 'home', $home == 1 ? 1 : 0]);
        }
        if ($footer > 0) {
            $news->andWhere(['=', 'footer', $footer == 1 ? 1 : 0]);
        }
        $news = $news->all();
        $ids = [];
        foreach ($news as $item) {
            $ids[] = $item->id;
        }
        $images = ImageBusiness::getByTarget($ids, ImageType::NEWS, true, true);
        foreach ($news as $item) {
            $item->images = isset($images[$item->id]) ? $images[$item->id] : [];
        }
        return $news;
    }

    /**
     * Get By Alias
     * @return type
     */
    public static function getByAlias($alias) {
        return News::findOne(["alias" => $alias]);
    }

}
