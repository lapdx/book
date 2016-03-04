<?php

namespace common\models\business;

use common\models\db\Meta;

class MetaBusiness {

    /**
     * Chi tiết 1 banner
     * @param type $id
     */
    public static function get($id) {
        return Meta::findOne($id);
    }

    public static function getPrimarykey($id, $type, $objId) {
        return Meta::find()->andWhere(['id' => $id])->andWhere(['type' => $type])->andWhere(['objectId' => $objId])->one();
    }

    public static function getByObj($type, $objectId) {
        return Meta::find()->andWhere(['type' => $type])->andWhere(['objectId' => $objectId])->one();
    }

}
