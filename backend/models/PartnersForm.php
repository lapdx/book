<?php

namespace backend\models;

use common\models\business\PartnersBusiness;
use common\models\db\Partners;
use common\models\output\Response;
use common\util\TextUtils;
use yii\base\Model;

class PartnersForm extends Model {

    public $id;
    public $name;
    public $website;
    public $email;
    public $phone;
    public $active;
    public $home;
    public $position;

    public function rules() {
        return [
            [['name','website','email','phone','position'], 'required', 'message' => '{attribute} không được để trống'],
            [['active', 'id', 'home'], 'integer'],
            [['name'], 'string','message' => '{attribute} ký tự'],
            [['email'], 'email','message' => '{attribute} không đúng định dạng'],
            [['phone','position'], 'number','message' => '{attribute} phải là số'],
            [['website'], 'url','message' => '{attribute} không đúng định dạng URL'],
        ];
    }

    public function attributeLabels() {
        return [
            'name' => 'Tên',
            'email' => 'Email',
            'phone' => 'Số điện thoại',
            'position' => 'Vị trí',
        ];
    }

    public function save() {
        if (!$this->validate()) {
            return new Response(false, "Dữ liệu không chính xác vui lòng nhập lại", $this->errors);
        }

        $partners = PartnersBusiness::get($this->id);
        if ($partners == null) {
            $partners = new Partners();
        }
        $partners->name = $this->name;
        $partners->position = $this->position;
        $partners->website = $this->website;
        $partners->email = $this->email;
        $partners->phone = '0'.$this->phone;
        $partners->active = $this->active == 1 ? 1 : 0;
        $partners->home = $this->home == 1 ? 1 : 0;

        if (!$partners->save(false)) {
            return new Response(false, "Dữ liệu truyền vào không chính xác vui lòng nhập lại", $partners->errors);
        }

        return new Response(true, "Change partners success", $partners);
    }


}
