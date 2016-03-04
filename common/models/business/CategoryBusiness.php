<?php

namespace common\models\business;

use common\models\db\Category;
use common\models\db\Item;
use common\models\enu\ImageType;
use common\models\inter\InterBusiness;
use common\models\output\Response;

class CategoryBusiness implements InterBusiness {

    /**
     * Menu
     * @param type $id
     * @return type
     */
    public static function get($id) {
        return Category::findOne($id);
    }

    /**
     * mget
     * @param type $ids
     * @return type
     */
    public static function mGet($ids) {
        return Category::find()->andWhere(["id" => $ids]);
    }

    /**
     * Thay đổi vị trí hiển thị
     * @param type $id
     * @return type
     */
    public static function changePosition($id, $postion) {
        $categorygory = Category::findOne($id);
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
        return Category::findOne(["alias" => $alias]);
    }

    public static function getParentId($id, $active = 0) {
        $query = Category::findAll(['parentId' => $id]);
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
        return Category::find(["alias" => $alias])->count() != 0;
    }

    /**
     * Thay đổi trạng thái newsCategory
     * @param type $id
     * @return type
     */
    public static function changeActive($id) {
        $new = Category::findOne($id);
        if ($new == null) {
            return new Response(false, "Danh mục không tồn tại");
        }
        $new->active = $new->active == 1 ? 0 : 1;

        if (!$new->save(false)) {
            return new Response(false, "Không lưu được danh mục ", $new->errors);
        }
        return new Response(true, "Danh mục  " . $new->name . $new->active ? "đã mở khóa" : "đã khóa", $new);
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
        Item::deleteAll(['categoryId' => $id]);
        return new Response(true, "Xóa danh mục thành công", Category::deleteAll(['id' => $id]));
    }

    /**
     * Lấy ra toàn bộ categoryNews
     * @return type
     */
    public static function getAll($active = 0, $id = '') {
        $newcate = Category::find();
        if ($active != 0) {
            $newcate->andWhere(['active' => $active == 1 || $active == true ? 1 : 0]);
        }
        if ($id != '' || $id != null) {
            $newcate->andWhere(['id' => $id]);
        }
        $newcate->orderBy('position ASC');
        $ids = [];
        $cats = $newcate->all();
        foreach ( $cats as $c) {
            $ids[] = $c->id;
        }
        $images = ImageBusiness::getByTarget($ids, ImageType::CATEGORY, true, true);
        foreach ($cats as $c) {
            $c->images = isset($images[$c->id]) ? $images[$c->id] : [];
        }
        return $cats;
    }

}
