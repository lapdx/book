<?php

namespace common\models\business;

use common\models\db\Home;
use common\models\enu\ImageType;

class HomeBusiness {


    public static function get($id) {
        $home = Home::findOne($id);
        $images = ImageBusiness::getByTarget([1], ImageType::LOGO,true,true);
        $home->logo =!empty($images)?$images['1']:[];
        return $home;
    }
}
