<?php

namespace common\util;

use Yii;

class EmailClient {

    public static function sendEmail($from, $to, $subject, $body, $charset = 'utf-8') {
        $compose = Yii::$app->mailer->compose()
                        ->setCharset($charset)
                        ->setFrom($from)->setTo($to)
                        ->setSubject($subject)->setHtmlBody($body);
        return $compose->send();
    }

}
