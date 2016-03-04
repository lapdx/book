<?php

namespace common\util;

use Exception;
use Yii;

class CdtClient {

    /**
     * push item
     * @param type $params
     * @return type
     */
    public static function push($params = []) {
        try {
            return self::call($params);
        } catch (Exception $exc) {
            return ["message" => $exc->getMessage()];
        }
    }

    /**
     * call service
     * @param type $params
     * @return type
     */
    private static function call($params) {
        $config = Yii::$app->params['chodientu'];
        $request = [];
        $request['code'] = $config['code'];
        $request['params'] = json_encode($params);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $config['rest']);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($request));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_ENCODING, 'UTF-8');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        $result = curl_exec($ch);
        curl_close($ch);
        return json_decode($result);
    }

}
