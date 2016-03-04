<?php

namespace backend\models;

use common\models\business\CategoryBusiness;
use common\models\business\ItemBusiness;
use common\models\db\Item;
use common\models\output\Response;
use yii\base\Model;

class ItemForm extends Model {

    public $id;
    public $name;
    public $content;
    public $description;
    public $active;
    public $startPrice;
    public $sellPrice;
    public $categoryId;
    public $partnersId;
    public $type;
    public $noise;
    public $power;
    public $origin;
    public $gift;

    public function rules() {
        return [
            [['name', 'description', 'sellPrice', 'startPrice', 'categoryId', 'origin', 'partnersId', 'power'], 'required', 'message' => "{attribute} không được để trống"],
            [['description', 'content'], 'string', 'message' => "{attribute} phải là ký tự"],
            [['active', 'id', 'sellPrice', 'startPrice', 'partnersId', 'type','noise', 'power'], 'integer', 'message' => "{attribute} phải là số"],
            [['name', 'origin','gift'], 'string', 'message' => "{attribute} phải là ký tự", 'max' => 255, 'tooLong' => "{attribute} tối đa là 255 ký tự"]
        ];
    }

    public function attributeLabels() {
        return [
            'id' => 'ID',
            'name' => 'Tên',
            'description' => 'Mô tả',
            'content' => 'Nội dung',
            'property' => 'Thuộc tính',
            'about' => 'Thông tin',
            'active' => 'Trạng thái',
            'sellPrice' => 'Giá bán',
            'startPrice' => 'Giá gốc',
            'categoryId' => 'Danh mục',
            'power' => 'Công suất',
            'type' => 'Loại bếp',
            'partnersId' => 'Hãng sản xuất',
            'origin' => 'Xuất xứ',
            'gift' => 'Quà tặng',
            'noise' => 'Độ ồn',
        ];
    }

    public function save() {
        if (!$this->validate()) {
            return new Response(false, "Dữ liệu không chính xác vui lòng nhập lại", $this->errors);
        }

        $item = ItemBusiness::get($this->id);
        if ($item == null) {
            $item = new Item();
            $item->createTime = time();
        }
        $item->name = $this->name;
        $item->description = $this->description;
        $item->gift = $this->gift;
        $item->noise = $this->noise;
        $item->sellPrice = $this->sellPrice;
        $item->startPrice = $this->startPrice;
        $cat = CategoryBusiness::get($this->categoryId);
        if (empty($cat)) {
           return new Response(false, "Danh mục không tồn tại",[]);  
        }
        $item->categoryId = $this->categoryId;
        $item->categoryName = $cat->name;
        $item->origin = $this->origin;
        $item->partnersId = $this->partnersId;
        $item->power = $this->power;
        $item->type = $this->type;
        $item->active = $this->active == 1 ? 1 : 0;
        $item->updateTime = time();

        if (!$item->save(false)) {
            return new Response(false, "Dữ liệu truyền vào không chính xác vui lòng nhập lại", $item->errors);
        }

        return new Response(true, "Lưu -- " . $item->name . " --  thành công", $item);
    }

    public function content() {
        $item = ItemBusiness::get($this->id);
        if ($item == null) {
            return new Response(false, "Không tìm thấy item này!", []);
        }
        $item->content = $this->content;
        if (!$item->save(false)) {
            return new Response(false, "Dữ liệu truyền vào không chính xác vui lòng nhập lại", $item->errors);
        }
        return new Response(true, "Lưu nội dung thành công", $item);
    }

}
