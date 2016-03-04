<?php

namespace common\models\business;

use common\models\db\Administrator;
use common\models\output\Response;
use common\util\TextUtils;
use Yii;

class AdministratorBusiness {

    /**
     * get by admin email
     * @param type $email
     * @return type
     */
    public static function get($email) {
        return Administrator::findOne($email);
    }

    /**
     * Admin change active
     * @param type $email
     * @return Response
     */
    public static function changeActive($email) {
        $admin = self::get($email);
        if ($admin == null) {
            return new Response(false, "Admin don't exits", []);
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
