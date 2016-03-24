<?php

namespace common\models\business;

use common\models\db\Administrator;
use common\models\db\User;
use common\models\output\Response;
use common\util\TextUtils;
use Yii;

class UserBusiness {

    /**
     * get by admin id
     * @param type $id
     * @return type
     */
    public static function get($id) {
        return User::findOne($id);
    }

    public static function getByLogin($username, $password, $type = 'admin') {
        $user = User::find()->andWhere(['=', 'username', $username])->andWhere(['=', 'type', $type])->one();
        if ($user != null) {
            try {
                if (Yii::$app->getSecurity()->validatePassword($password, $user->password)) {
                    return $user;
                } else {
                    return null;
                }
            } catch (Exception $exc) {
                return null;
            }
        }
        return $user;
    }

    public static function getByUsername($username, $id) {
        return User::find()->andWhere(['=', 'username', $username])->andWhere(['<>', 'id', $id])->one();
    }

    /**
     * Admin change active
     * @param type $id
     * @return Response
     */
    public static function changeActive($id) {
        $admin = self::get($id);
        if ($admin == null) {
            return new Response(false, "User don't exits", []);
        }
        $admin->active = $admin->active ? 0 : 1;
        $admin->save();
        return new Response(true, "Change active success", $admin);
    }

    public static function remove($id) {
        $admin = self::get($id);
        if ($admin == null) {
            return new Response(true, "Tài khoản " . $id . " đã được xóa khỏi hệ thống");
        }
        $auth = Yii::$app->authManager;
        if ($auth->getAssignment('admin', $id)) {
            $auth->revoke($auth->getRole('admin'), $id);
        }
        if ($auth->getAssignment('superadmin', $id)) {
            $auth->revoke($auth->getRole('superadmin'), $id);
        }
        $admin->delete();
        return new Response(true, "Tài khoản " . $admin->username . " đã được xóa khỏi hệ thống");
    }

    public static function resetPassword($id) {
        $admin = self::get($id);
        if ($admin == null) {
            return new Response(false, "User don't exits", []);
        }
        $admin->password = md5("123456lapdx");
        $admin->save();
        return new Response(true, "Password  account " . $admin->username . " is 123456", $admin);
    }

}
