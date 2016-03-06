<?php

namespace backend\models;

use common\models\business\NewsCategoryBusiness;
use common\models\db\NewsCategory;
use common\models\output\Response;
use common\util\TextUtils;
use Yii;
use yii\base\Model;

class NewsCategoryForm extends Model {

    public $id;
    public $alias;
    public $name;
    public $description;
    public $parentId;
    public $active;
    public $position;

    public function rules() {
        return [
            [['alias', 'name', 'description'], 'required', 'message' => '{attribute} không được để trống'],
            [['description'], 'string'],
            [['parentId', 'active','position', 'id'], 'integer', 'message' => '{attribute} phải là số'],
            [['alias', 'name'], 'string', 'max' => 220],
        ];
    }

    public function attributeLabels() {
        return [
            'name' => 'Tên danh mục',
            'description' => 'Mô tả',
            'position' => 'Vị trí'
        ];
    }

    public function save() {
        if (!$this->validate()) {
            return new Response(false, "Thông tin dữ liệu không chính xác , vui lòng nhập lại", $this->errors);
        }

        $cate = NewsCategoryBusiness::get($this->id);
        if ($cate == null) {
            $cate = new NewsCategory();
            $cate->createTime = time();
        } else {
            if ($this->parentId != $cate->parentId) {
                if ($cate->parentId == 0 && NewsCategoryBusiness::getParentId($this->id) != null) {
                    return new Response(false, "Danh mục này hiện tại đang có danh mục con tồn tại vui lòng di chuyển hoặc xóa danh mục con", ['parentId' => 'Vui lòng chọn danh mục khác']);
                }
                if ($this->parentId == $cate->id) {
                    return new Response(false, "Vui lòng chọn danh mục khác ", ['parentId' => 'Vui lòng chọn danh mục khác']);
                }
            }
        }





        if ($this->parentId != 0) {
            $parent = NewsCategoryBusiness::get($this->parentId);
            if ($parent == null) {
                return new Response(false, "Danh mục cha không tồn tại!", $this->errors);
            } else {
                $cate->parentId = $this->parentId;
            }
        } else {
            $cate->parentId = 0;
        }
        $cate->name = $this->name;

        $cate->alias = $this->genAlias();
        $cate->description = $this->description;
        $cate->active = $this->active == 1 ? 1 : 0;
        $cate->position = $this->position;
        $cate->updateTime = time();
        if (!$cate->save()) {
            return new Response(false, "Thao tác thất bại", $cate->errors);
        }
        return new Response(true, "Thao tác với danh mục tin -- " . $cate->name . " -- thành công", $cate);
    }

    private function genAlias() {
        $alias = $this->alias;
        if ($alias == null || $alias == "") {
            $alias = TextUtils::removeMarks($this->name);
        }
        return trim($alias);
    }

}
