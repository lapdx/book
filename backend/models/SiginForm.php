<?php

namespace backend\models;

use common\models\business\AdministratorBusiness;
use common\models\db\Administrator;
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
        $admin = AdministratorBusiness::get($this->email);
        if ($admin == null) {
            $admin = new Administrator();
            $admin->active = 0;
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
            return new Response(false, "Account " . $admin->id . ' are locked', $admin);
        }
        return new Response(true, "Sign successful", $admin);
    }

}
