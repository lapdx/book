<?php

namespace frontend\models;

use common\models\business\UserBusiness;
use common\models\db\User;
use common\models\output\Response;
use Yii;
use yii\base\Model;

class SiginForm extends Model {

    public $email;
    public $description;
    public $remember;

    public function rules() {
        return [
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'filter', 'filter' => 'trim'],
            ['description', 'string'],
            ['remember', 'boolean'],
        ];
    }

    /**
     * Đăng nhập
     * @return Response
     */
    public function signin() {
        if (!$this->validate()) {
            return new Response(false, "Incorrect data", $this->errors);
        }
        $admin = UserBusiness::get($this->email);
        if ($admin == null) {
            $admin = new User();
            $admin->active = 1;
            $admin->id = $this->email;
            $admin->description = $this->description;
            $admin->joinTime = time();
        }
        if ($this->remember) {
            $admin->rememberKey = Yii::$app->getSecurity()->generateRandomString();
        }
        $admin->lastTime = time();
        $admin->save();
        if (!$admin->active) {
            return new Response(false, "Tài khoản " . $admin->id . ' đang bị khóa', $admin);
        }
        return new Response(true, "Đăng nhập thành công", $admin);
    }

}
