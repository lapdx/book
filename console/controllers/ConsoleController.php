<?php

namespace console\controllers;

use yii\console\Controller;

class ConsoleController extends Controller {

    /**
     * Mã hoá dữ liệu
     * @param type $data
     * @return type
     */
    protected function encode($data) {
        if (is_object($data) || is_array($data)) {
            $data = json_encode($data);
        }
        return empty($data) ? null : base64_encode($data);
    }

}
