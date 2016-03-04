<?php

use yii\helpers\Html;

$config = \Yii::$app->params['email'];
/* @var $this \yii\web\View view component instance */
/* @var $message \yii\mail\MessageInterface the message being composed */
/* @var $content string main view render result */
?>
<?php $this->beginPage() ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=<?= Yii::$app->charset ?>" />
        <title><?= Html::encode($this->title) ?></title>
<?php $this->head() ?>
    </head>
    <body>
<?php $this->beginBody() ?>
        <table border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="#fff" width="650" style="border:1px solid #eee;">
            <tbody>
                <tr>
                    <td valign="top">
                        <div style="height:90px; background:#fff;">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tbody>
                                    <tr>
                                        <td valign="top" style="text-align:center;">
                                            <a href="<?= $config['baseUrl'] ?>" style="border:none;"><img src="<?= $config['baseUrl'] ?>images/logo.png" alt="logo" style="border:none;" /></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td valign="top" style="background:#fff;">
                        <table border="0" cellpadding="0" cellspacing="0" align="left" width="100%" bgcolor="#fff">
                            <tbody>
                                <tr>
                                    <td valign="top" width="20%" style="padding:12px 0; color:#343639; border-right:1px solid #da7500; background:#fa8600; text-align:center;">
                                        <a href="<?= $config['baseUrl'] ?>" style="font-family:Arial, Helvetica, sans-serif; font-size: 14px; font-weight:bold; color:#fff; text-decoration:none;">Trang chủ</a>
                                    </td>
                                    <td valign="top" width="20%" style="padding:12px 0; color:#343639; border-right:1px solid #da7500; background:#fa8600; text-align:center;">
                                        <a href="<?= $config['baseUrl'] ?>" style="font-family:Arial, Helvetica, sans-serif; font-size: 14px; font-weight:bold; color:#fff; text-decoration:none;">Sản phẩm</a>
                                    </td>
                                    <td valign="top" width="20%" style="padding:12px 0; color:#343639; border-right:1px solid #da7500; background:#fa8600; text-align:center;">
                                        <a href="<?= $config['baseUrl'] ?>" style="font-family:Arial, Helvetica, sans-serif; font-size: 14px; font-weight:bold; color:#fff; text-decoration:none;">Khuyến mại</a>
                                    </td>
                                    <td valign="top" width="20%" style="padding:12px 0; color:#343639; border-right:1px solid #da7500; background:#fa8600; text-align:center;">
                                        <a href="<?= $config['baseUrl'] ?>" style="font-family:Arial, Helvetica, sans-serif; font-size: 14px; font-weight:bold; color:#fff; text-decoration:none;">Tin tức</a>
                                    </td>
                                    <td valign="top" width="20%" style="padding:12px 0; color:#343639; background:#fa8600; text-align:center;">
                                        <a href="<?= $config['baseUrl'] ?>" style="font-family:Arial, Helvetica, sans-serif; font-size: 14px; font-weight:bold; color:#fff; text-decoration:none;">Liên hệ</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>	
                    </td>
                </tr>
                <tr>
<?= $content ?>
                </tr>
                <tr>
                    <td valign="top" style="background:#fff;">
                        <table border="0" cellpadding="0" cellspacing="0" align="left" width="100%" bgcolor="#fff">
                            <tbody>
                                <tr>
                                    <td valign="top">
                                        <div style="padding-top:10px; padding-right:10px; padding-bottom:10px; padding-left:25px; line-height:20px; font-weight:normal; background:#cb6f00; text-align:center;">
                                            <font style="font-family:Arial, Helvetica, sans-serif; font-size: 12px; color:#fff;">                                  	
                                                Tư vấn online: <span style="color:#fff;">(84) 977.112.887</span> | Giờ bán hàng: <span style="color:#fff;">8.00 AM - 21:00 PM</span>
                                            </font>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>	
                    </td>
                </tr>
            </tbody>
        </table>
<?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
