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

    public static function getByLogin($username,$password,$type='admin'){
        return User::find()->andWhere(['=','username',$username])->andWhere(['=','password',$password])->andWhere(['=','type',$type])->one();
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
        return new Response(true, "Tài khoản " . $admin->id . " đã được xóa khỏi hệ thống");
    }

    /**
     * 
     * @param Administrator $admin
     * @return type
     */
    public static function getCode(Administrator $admin) {
        return md5(trim(TextUtils::removeMarks($admin->id . "-" . $admin->joinTime)));
    }

}
