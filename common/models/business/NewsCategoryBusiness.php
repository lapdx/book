<?php

namespace common\models\business;

use common\models\db\News;
use common\models\db\NewsCategory;
use common\models\inter\InterBusiness;
use common\models\output\Response;

class NewsCategoryBusiness implements InterBusiness {

    /**
     * Menu
     * @param type $id
     * @return type
     */
    public static function get($id) {
        return NewsCategory::findOne($id);
    }

    /**
     * mget
     * @param type $ids
     * @return type
     */
    public static function mGet($ids) {
        return NewsCategory::find()->andWhere(["id" => $ids]);
    }

    /**
     * Thay đổi vị trí hiển thị
     * @param type $id
     * @return type
     */
    public static function changePosition($id, $postion) {
        $categorygory = NewsCategory::findOne($id);
        if ($categorygory == null) {
            return new Response(false, "Danh mục không tồn tại");
        }
        $categorygory->position = $postion;
        $categorygory->save(false);
        return new Response(true, "Thay đổi trạng thái hiển thị thành công", $categorygory);
    }

    /**
     * Get By Alias
     * @return type
     */
    public static function getByAlias($alias) {
        return NewsCategory::findOne(["alias" => $alias]);
    }

    public static function getParentId($id, $active = 0) {
        $query = NewsCategory::findAll(['parentId' => $id]);
        if ($active != 0) {
            $query->andWhere(['active' => $active == 1 || $active == true ? 1 : 0]);
        }
        return $query;
    }

    /**
     * Kiểm tra alias
     * @param type $alias
     * @return type
     */
    public static function exitsAlias($alias) {
        return NewsCategory::find(["alias" => $alias])->count() != 0;
    }

    /**
     * Thay đổi trạng thái newsCategory
     * @param type $id
     * @return type
     */
    public static function changeActive($id) {
        $new = NewsCategory::findOne($id);
        if ($new == null) {
            return new Response(false, "Danh mục tin tức không tồn tại");
        }
        $new->active = $new->active == 1 ? 0 : 1;

        if (!$new->save(false)) {
            return new Response(false, "Không lưu được danh mục tin tức", $new->errors);
        }
        return new Response(true, "Danh mục tin tức " . $new->name . $new->active ? "đã mở khóa" : "đã khóa", $new);
    }

    public static function changeMenu($id) {
        $new = NewsCategory::findOne($id);
        if ($new == null) {
            return new Response(false, "Danh mục tin tức không tồn tại");
        }
        $new->menu = $new->menu == 1 ? 0 : 1;

        if (!$new->save(false)) {
            return new Response(false, "Không lưu được danh mục tin tức", $new->errors);
        }
        return new Response(true, "Danh mục tin tức " . $new->name . $new->menu ? "đã mở khóa" : "đã khóa", $new);
    }

    /**
     * Xóa newsCate hiện hành
     * @param type $id
     */
    public static function remove($id) {
        $query = self::get($id);
        if ($query->parentId == 0) {
            if (self::getParentId($query->id) != null) {
                return new Response(false, "Xóa danh mục con trước khi thực hiện thao tác này");
            }
        }
        News::deleteAll(['categoryId' => $id]);
        return new Response(true, "Xóa danh mục tin tức thành công", NewsCategory::deleteAll(['id' => $id]));
    }

    /**
     * Lấy ra toàn bộ categoryNews
     * @return type
     */
    public static function getAll($active = 0, $id = '', $menu = 0) {
        $newcate = NewsCategory::find();
        if ($active != 0) {
            $newcate->andWhere(['active' => $active == 1 || $active == true ? 1 : 0]);
        }
        if ($menu != 0) {
            $newcate->andWhere(['menu' => $menu == 1 || $menu == true ? 1 : 0]);
        }
        if ($id != '' || $id != null) {
            $newcate->andWhere(['id' => $id]);
        }
        $newcate->orderBy('position');
        return $newcate->all();
    }

}
