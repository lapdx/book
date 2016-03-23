<?php

namespace backend\models;

use common\models\business\UserBusiness;
use common\models\db\User;
use common\models\output\Response;
use yii\base\Model;

class UserForm extends Model {

    public $id;
    public $username;
    public $password;
    public $repassword;
    public $email;
    public $active;
    public $type;
    public $phone;
    public $fullname;

    public function rules() {
        return [
            [['username', 'type'], 'required', 'message' => '{attribute} không được để trống!'],
            [['phone','id', 'active'], 'integer', 'message' => '{attribute} phải là số !'],
            ['password', 'compare', 'compareAttribute' => 'repassword','message' => '{attribute} không khớp !'],
            [['fullname', 'email'], 'string', 'message' => '{attribute} phải là ký tự !'],
            [['email'], 'email', 'message' => '{attribute} không đúng định dạng !'],
            [['repassword','password'],'safe']
        ];
    }

    public function attributeLabels() {
        return [
            'id' => 'ID',
            'username' => 'Tài khoản',
            'password' => 'Mật khẩu',
            'active' => 'Trạng thái',
            'type' => 'Loại',
            'email' => 'Email',
            'fullname' => 'Tên',
            'phone' => 'Số điện thoại',
        ];
    }

    public function save() {
        if (!$this->validate()) {
            return new Response(false, "Dữ liệu không hợp lệ !", $this->errors);
        }
        $user = UserBusiness::get($this->id);
        if ($user == null) {
            $user = new User();
            if (empty($this->password)) {
                return new Response(false, "Mật khẩu không được để trống");
            }
        }
        $u = UserBusiness::getByUsername($this->username,$this->id);
        if ($u != null) {
            return new Response(false, "Tài khoản " . $this->username . " đã tồn tại");
        }
        $user->fullname = $this->fullname;
        $user->email = $this->email;
        $user->username = $this->username;
        $user->phone = '0' . $this->phone;
        $user->type = $this->type;
        $user->active = $this->active == 1 ? 1 : 0;
        if (empty($this->password)) {
            $user->password = $user->password;
        } else {
            $user->password = \Yii::$app->getSecurity()->generatePasswordHash($this->password);
        }
        if (!$user->save(false)) {
            return new Response(false, "Không lưu được vào csdl", $user->errors);
        }
        return new Response(true, "Lưu ok", $user);
    }

}
