<?php

use common\util\TextUtils;
use common\util\UrlUtils;
use frontend\assets\AppAsset;
use frontend\assets\WebAsset;
use yii\helpers\Html;

AppAsset::register($this);
WebAsset::register($this);

?>
<?php $this->beginPage() ?>
<?php include('header.php');?>
<?php $this->beginBody() ?>
<?= $content ?>
<?php $this->endBody() ?>
<?php include('footer.php');?>
<?php $this->endPage() ?>
