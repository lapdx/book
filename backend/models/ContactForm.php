<?php

namespace backend\models;

use common\models\business\ContactBusiness;
use common\models\db\Contact;
use common\models\output\Response;
use yii\base\Model;

class ContactForm extends Model {

    public $id;
    public $name;
    public $email;
    public $content;
    public $phone;
    public $address;

    public function rules() {
        return [
            [['name', 'email','content'], 'required', 'message' => '{attribute} không được để trống!'],
            [['id','phone'], 'integer', 'message' => '{attribute} phải là số !'],
            [['content', 'name', 'email','address'], 'string', 'message' => '{attribute} phải là ký tự !'],
            [['email'], 'email', 'message' => '{attribute} không đúng định dạng !'],
        ];
    }

    public function attributeLabels() {
        return [
            'id' => "Mã liên hệ",
            'name' => "Tên liên hệ",
            'email' => "Email",
            'content' => "Thông điệp",
            'phone' => "Số điện thoại",
            'address' => "Địa chỉ",
        ];
    }

    public function save() {
        if (!$this->validate()) {
            return new Response(false, "Dữ liệu không hợp lệ !", $this->errors);
        }
        $contact = ContactBusiness::get($this->id);
        if ($contact == null) {
            $contact = new Contact();
            $contact->createTime = time();
        }
        $contact->name = $this->name;
        $contact->email = $this->email;
        $contact->address = $this->address;
        $contact->phone = '0'.$this->phone;
        $contact->content = $this->content;
        $contact->updateTime = time();
        if (!$contact->save(false)) {
            return new Response(false, "Không lưu được vào csdl", $contact->errors);
        }
        return new Response(true, "Lưu ok", $contact);
    }

}
