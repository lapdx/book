<?php

namespace backend\models;

use common\models\business\UserBusiness;
use common\models\output\Response;
use Yii;
use yii\base\Model;

class SiginForm extends Model {

    public $username;
    public $password;

    public function rules() {
        return [
            [['username','password'], 'required'],
            ['username', 'filter', 'filter' => 'trim'],
        ];
    }
    /**
     * Đăng nhập
     * @return Response
     */
    public function signin() {
        if (!$this->validate()) {
            return new Response(false, "Vui lòng nhập đầy đủ dữ liệu", $this->errors);
        }
        $admin = UserBusiness::getByLogin($this->username,md5($this->password.'lapdx'));
        if ($admin == null) {
           return new Response(false, "Tài khoản hoặc mật khẩu không đúng", []);
        }
        if (!$admin->active) {
            return new Response(false, "Account " . $admin->id . ' are locked', $admin);
        }
        return new Response(true, "Sign successful", $admin);
    }

}
