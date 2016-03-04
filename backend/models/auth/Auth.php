<?php

namespace backend\models\auth;

use common\models\business\AdministratorBusiness;
use nodge\eauth\ServiceBase;
use yii\base\ErrorException;
use yii\base\Object;
use yii\web\IdentityInterface;
use yii\web\User;

class Auth extends Object implements IdentityInterface {

    public $id;
    public $authKey;

    public static function findIdentity($id) {
        $admin = AdministratorBusiness::get($id);
        $auth = new Auth();
        $auth->id = $admin->id;
        return $auth;
    }

    /**
     * @param ServiceBase $service
     * @return User
     * @throws ErrorException
     */
    public function getId() {
        return $this->id;
    }

    public function getAuthKey() {
        return $this->authKey;
    }

    public function validateAuthKey($authKey) {
        return $this->authKey === $authKey;
    }

    /**
     * Finds an identity by the given secrete token.
     *
     * @param string $token the secrete token
     * @param null $type type of $token
     * @return IdentityInterface the identity object that matches the given token.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentityByAccessToken($token, $type = null) {
        // TODO: Implement findIdentityByAccessToken() method.
        return null;
    }

}
