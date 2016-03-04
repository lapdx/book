<?php

namespace backend\models;

use common\models\business\BannerBusiness;
use common\models\db\Banner;
use common\models\output\Response;
use yii\base\Model;

class BannerForm extends Model {

    public $id;
    public $name;
    public $active;
    public $link;
    public $position;
    public $type;
    public $description;

    public function rules() {
        return [
            [['name', 'type'], 'required', 'message' => '{attribute} không được để trống!'],
            [['active', 'position', 'id'], 'integer'],
            [['name', 'link'], 'string', 'max' => 220],
            [['type'], 'string', 'max' => 50],
            [['description'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels() {
        return [
            'name' => "Tên banner",
            'link' => "Link banner",
            'type' => "Kiểu banner",
            'description' => "Mô tả",
        ];
    }

    public function save() {
        if (!$this->validate()) {
            return new Response(false, "Dữ liệu nhập vào chưa chính xác , vui lòng nhập lại", $this->errors);
        }
        $banner = BannerBusiness::get($this->id);
        if ($banner == null) {
            $banner = new Banner();
        }
        $banner->type = $this->type;
        $banner->name = $this->name;
        $banner->active = $this->active == 1 ? 1 : 0;
        $banner->position = $this->position;
        $banner->link = $this->link;
        $banner->description = $this->description;

        if (!$banner->save() || !$banner->validate()) {
            return new Response(false, "Dữ liệu nhập vào chưa chính xác , vui lòng nhập lại", $banner->errors);
        }

        return new Response(true, "Thao tác dữ liệu thành công", $banner);
    }

}
