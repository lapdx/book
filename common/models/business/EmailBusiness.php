<?php

namespace common\models\business;

use common\util\EmailClient;
use yii\swiftmailer\Mailer;

class EmailBusiness {

    public static function send($to, $subject, $template, $vars = array(), $layout = 'layouts/basic', $charset = 'utf-8') {
        EmailClient::sendEmail("noreply.hoalua@gmail.com", $to, $subject, self::render($template, $vars, $layout));
    }

    /**
     * 
     * @param type $template
     * @param array $vars
     * @param type $baseUrl
     * @param type $layout
     * @return type
     */
    public static function render($template, $vars, $layout = '/layouts/basic') {
        $mailer = new Mailer();
        $mailer->setViewPath("@common/mail");
        return $mailer->render($template, $vars, $layout);
    }

}
