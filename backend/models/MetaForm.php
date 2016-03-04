<?php

namespace backend\models;

use common\models\business\MetaBusiness;
use common\models\db\Meta;
use common\models\output\Response;
use yii\base\Model;

class MetaForm extends Model {

    public $id;
    public $type;
    public $objectId;
    public $title;
    public $description;
    public $keyword;

    public function rules() {
        return [
            [['objectId', 'type','title', 'description', 'keyword'], 'required', 'message' => '{attribute} không được để trống!'],
            [['objectId', 'id'], 'integer'],
            [['title', 'description', 'keyword'], 'string', 'max' => 500],
            [['type'], 'string', 'max' => 50],
        ];
    }

    public function attributeLabels() {
        
    }

    public function save() {
        if (!$this->validate()) {
            return new Response(false, "Dữ liệu nhập vào chưa chính xác , vui lòng nhập lại", $this->errors);
        }
        $meta = MetaBusiness::getByObj($this->type, $this->objectId);
        if (empty($meta)) {
            $meta = new Meta();
        }
        $meta->type = $this->type;
        $meta->description = $this->description;
        $meta->title = $this->title;
        $meta->objectId = $this->objectId;
        $meta->keyword = $this->keyword;
        if (!$meta->save(false)) {
            return new Response(false, "Dữ liệu nhập vào chưa chính xác , vui lòng nhập lại", $meta->errors);
        }
        return new Response(true, "Thao tác dữ liệu thành công", $meta);
    }

}
