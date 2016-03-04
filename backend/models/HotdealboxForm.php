<?php

namespace backend\models;

use common\models\business\HotdealboxBusiness;
use common\models\business\ItemBusiness;
use common\models\db\Hotdealbox;
use common\models\output\Response;
use yii\base\Model;
use Yii;

class HotdealboxForm extends Model {

    public $id;
    public $itemId;
    public $type;

    public function rules() {
        return [
            [['itemId','type'], 'required', 'message' => '{attribute} không được để trống!'],
            [['itemId'], 'integer', 'message' => '{attribute} phải là số!'],
        ];
    }

    public function attributeLabels() {
        return [
            'id' => "Mã",
            'itemId' => "Mã sản phẩm",
        ];
    }

    /**
     * Lưu sản phẩm nổi bật
     * @return Response
     */
    public function save() {
        if (!$this->validate()) {
            return new Response(false, "Dữ liệu nhập vào chưa chính xác , vui lòng nhập lại", $this->errors);
        }
        $hotdeal = HotdealboxBusiness::get($this->id);
        if ($hotdeal == null) {
            $hotdeal = new Hotdealbox();
        }
        if (ItemBusiness::get($this->itemId) == null) {
            return new Response(false, "Sản phẩm không tồn tại  trên hệ thống !", ["itemId" => "Sản phẩm không tồn tại!"]);
        }
        if (HotdealboxBusiness::getByItemId($this->itemId) != null) {
            return new Response(false, "Sản phẩm đã được thêm!", ["itemId" => "Sản phẩm có mã " . $this->itemId . " đã là sản phẩm nổi bật!"]);
        }
        $hotdeal->itemId = $this->itemId;
        $hotdeal->active = 1;
        $hotdeal->type = $this->type;

        if (!$hotdeal->save()) {
            return new Response(false, "Dữ liệu nhập vào chưa chính xác , vui lòng nhập lại", $hotdeal->errors);
        }
        return new Response(true, "Thêm sản phẩm nổi bật thành công!", $hotdeal);
    }

}
