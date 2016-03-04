<?php

namespace common\models\business;

use common\models\db\Contact;
use common\models\output\Response;

class ContactBusiness {

    /**
     * Chi tiết Liên hệ
     * @param type $id
     */
    public static function get($id) {
        return Contact::findOne($id);
    }
    /**
     * Chi tiết liên hệ
     * @param type $id
     */
    public static function getByEmail($email) {
        return Contact::findOne(['email'=>$email]);
    }

    /**
     * Xóa Brand theo id
     * @param type $id
     */
    public static function remove($id) {
        $contact = self::get($id);
        if ($contact == null) {
            return new Response(false, "Liên hệ không tồn tại");
        }
        $contact->delete();
        return new Response(true, "Xóa liên hệ thành công");
    }

}
