<?php

namespace frontend\models;

use common\models\business\ContactBusiness;
use common\models\db\Contact;
use common\models\output\Response;
use yii\base\Model;

class ContactForm extends Model {

    public $id;
    public $email;

    public function rules() {
        return [
            [['id'], 'integer', 'message' => '{attribute} phải là số !'],
            [['email'], 'required', 'message' => '{attribute} không được để trống !'],
            [['email'], 'email', 'message' => '{attribute} không đúng định dạng !'],
        ];
    }

    public function attributeLabels() {
        return [
            'id' => "Mã",
            'email' => "Email",
        ];
    }

    public function save() {
        if (!$this->validate()) {
            return new Response(false, $this->errors['email'][0], $this->errors);
        }
        if (!empty(ContactBusiness::getByEmail($this->email))) {
            return new Response(false, "Email này đã được đăng ký nhận bản tin", []);
        }
        $contact = new Contact();
        $contact->createTime = time();
        $contact->email = $this->email;
        if (!$contact->save(false)) {
            return new Response(false, "Không lưu được vào csdl", $contact->errors);
        }
        return new Response(true, "Bạn đã đăng ký thành công email nhận bản tin của Hoa lửa  !", $contact);
    }

}
