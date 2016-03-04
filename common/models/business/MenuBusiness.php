<?php

namespace common\models\business;

use common\models\db\Menu;
use common\models\inter\InterBusiness;
use common\models\output\Response;

class MenuBusiness implements InterBusiness {

    /**
     * Menu
     * @param type $id
     * @return type
     */
    public static function get($id) {
        return Menu::findOne($id);
    }

    /**
     * get grid
     * @param type $active
     * @return type
     */
    public static function getGrid($active = 0) {
        $find = Menu::find();
        if ($active > 0) {
            $find->andWhere(["active" => $active == 1 ? 1 : 0]);
        }
        $find->orderBy("position asc");
        return $find->all();
    }

    /**
     * mget
     * @param type $ids
     * @return type
     */
    public static function mGet($ids) {
        return Menu::find()->andWhere(["id" => $ids]);
    }

    /**
     * 
     * @param type $parId
     * @return type
     */
    public static function findByParentId($parId) {
        return Menu::findAll(['parentId' => $parId]);
    }

    /**
     * 
     * @param type $id
     * @return Response
     */
    public static function remove($id) {
        $menu = self::get($id);
        if (count(self::findByParentId($menu->id)) > 0) {
            return new Response(false, "Vui lòng xóa danh mục con trước ! ");
        }
        Menu::deleteAll(['id' => $menu->id]);
        return new Response(true, "Xóa thành công menu");
    }

}
