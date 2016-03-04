<?php

namespace backend\models;

use common\models\business\HomeBusiness;
use common\models\db\Home;
use common\models\output\Response;
use yii\base\Model;

class HomeForm extends Model {

    public $id;
    public $facebook;
    public $skype;
    public $google;
    public $youtube;
    public $twitter;
    public $phoneconsult;
    public $phonecare;
    public $address1;
    public $address2;
    public $address3;
    public $tel1;
    public $tel2;
    public $tel3;
    public $description1;
    public $description2;
    public $description3;
    public $time;
    public $email;

    public function rules() {
        return [
            [['id', 'facebook','email', 'google','skype', 'youtube', 'twitter', 'phoneconsult', 'phonecare', 'address1', 'address2', 'address3', 'tel1', 'tel2', 'tel3', 'description1', 'description2', 'description3', 'time'], 'required', 'message' => "{attribute} không được để trống"],
            [['id'], 'integer'],
        ];
    }

    public function attributeLabels() {
        return [
            'id' => 'ID',
            'facebook' => 'Facebook',
            'skype' => 'Skype',
            'google' => 'Google',
            'youtube' => 'Youtube',
            'twitter' => 'Twitter',
            'phoneconsult' => 'ĐT tư vấn',
            'phonecare' => 'ĐT chăm sóc',
            'address1' => 'Địa chỉ HN1',
            'address2' => 'Địa chỉ HN2',
            'address3' => 'Địa chỉ TPHCM',
            'tel1' => 'Telephone HN1',
            'tel2' => 'Telephone HN2',
            'tel3' => 'Telephone TPHCM',
            'description1' => 'Ghi chú HN1',
            'description2' => 'Ghi chú HN2',
            'description3' => 'Ghi chú TPHCM',
            'time' => 'Thời gian bán hàng',
            'email' => 'Email'
        ];
    }

    public function save() {
        if (!$this->validate()) {
            return new Response(false, "Dữ liệu không chính xác vui lòng nhập lại", $this->errors);
        }

        $home = HomeBusiness::get($this->id);
        if ($home == null) {
            $home = new Home();
            $home->id = $this->id;
        }
        unset($home->logo);
        $home->skype = $this->skype;
        $home->facebook = $this->facebook;
        $home->google = $this->google;
        $home->youtube = $this->youtube;
        $home->twitter = $this->twitter;
        $home->phoneconsult = substr($this->phoneconsult,0,1)=='0'?$this->phoneconsult:'0'.$this->phoneconsult;
        $home->phonecare = substr($this->phonecare,0,1)=='0'?$this->phonecare:'0'.$this->phonecare;
        $home->address1 = $this->address1;
        $home->address2 = $this->address2;
        $home->address3 = $this->address3;
        $home->tel1 = substr($this->tel1,0,1)=='0'?$this->tel1:'0'.$this->tel1;
        $home->tel2 = substr($this->tel2,0,1)=='0'?$this->tel2:'0'.$this->tel2;
        $home->tel3 = substr($this->tel3,0,1)=='0'?$this->tel3:'0'.$this->tel3;
        $home->description1 = $this->description1;
        $home->description2 = $this->description2;
        $home->description3 = $this->description3;
        $home->time = $this->time;
        $home->email = $this->email;

        if (!$home->save(false)) {
            return new Response(false, "Dữ liệu truyền vào không chính xác vui lòng nhập lại", $home->errors);
        }

        return new Response(true, "Lưu thành công", $home);
    }

}
