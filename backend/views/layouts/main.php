<?php

use backend\assets\AppAsset;
use backend\assets\LibAsset;
use backend\assets\WebAsset;
use yii\helpers\Html;

AppAsset::register($this);
LibAsset::register($this);
WebAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="<?= $this->context->baseUrl ?>images/favicon.ico" />
        <?= Html::csrfMetaTags() ?>
        <title data-rel="title" ><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>
        <div class="navbar navbar-default" role="navigation" data-rel="navigation" ></div>
        <div class="tree-view">
            <div class="container">
                <div class="admin-right">
                    <div class="user-label">
                        <div class="user-avatar"><img src="images/no_avatar.png" alt="avatar" /></div>
                        <?= Yii::$app->user->getId() ?>
                        <b class="caret"></b>
                    </div>
                    <ul>
                        <li><a style="cursor: pointer" onclick="auth.sigout();">Sigout<span class="glyphicon glyphicon-off"></span></a></li>
                    </ul>
                </div><!-- /admin-right -->
                <ol class="breadcrumb" data-rel="breadcrumb" ></ol>
            </div><!-- /container -->
        </div><!-- /tree-view -->
        <div class="tree-line"></div>
        <div class="container" data-rel="container" >
            <?= $content ?>
            <?php $this->endBody() ?>
        </div><!-- /container -->
        <div class="footer">
            <div class="container">
                © 2013 - 2014 <a href="#">Peacesoft Solutions Corporation.</a> All rights reserved
            </div><!-- /container -->
        </div><!-- footer -->
        <div class="top"></div>
        <div id="loading"><div class="loading-img">Loading...</div></div>
        <script type="text/javascript" >
            var account = '<?= Yii::$app->user->getId() ?>';
            var baseUrl = '<?= $this->context->baseUrl; ?>';
            Fly.init({
                baseUrl: '<?= $this->context->baseUrl; ?>',
                template: 'tpl/',
                default: ["index", "grid"],
                beforeLoad: function() {
                    if (account == "" && location.hash.indexOf("#auth/signin") == -1) {
                        console.log("red #auth/signin");
                        location.hash = "#auth/signin";
                        location.reload();
                        return false;
                    }
                },
                load: function() {
                    Fly.navigate();
					layout.init();
                },
                error_404: function() {
                    var html = Fly.template('error/404.tpl');
                    $("div[data-rel=container]").html(html);
                }
            });
<?= $this->context->staticClient; ?>
        </script>
    </body>
</html>
<?php $this->endPage() ?>
