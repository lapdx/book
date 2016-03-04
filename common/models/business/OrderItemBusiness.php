<?php

namespace common\models\business;

use common\models\db\OrderItem;
use common\models\inter\InterBusiness;

class OrderItemBusiness implements InterBusiness {

    /**
     * 
     * @param type $id
     * @return type
     */
    public static function get($id) {
        
    }

    public static function mGet($condition) {
        return OrderItem::findAll($condition);
    }

}
