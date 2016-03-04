<?php

use yii\helpers\Html;
?>

<div class="cms-content">
    <h1 class="func-title">
        <i class="fa fa-tags"></i>
        Error in system
    </h1>
    <div class="panel panel-default panel-tabs" style="margin-bottom: 0px;" >
        <div class="panel-heading">
            <ul class="nav nav-tabs" role="tablist">
                <li class="active"><a>Action controller</a></li>
                <li><a>Error 500</a></li>
                <li><a>Error 404</a></li>
                <li><a>Alert</a></li>
            </ul>
        </div>
    </div>
    <div class="func-container">
        <div class="alert alert-danger text-center" style="margin-bottom: 0px;" >
            <h3 style="margin-top: 0px;" >Action controller</h3>
            <p style="font-size: 14px;" ><?= nl2br(Html::encode($message)) ?></p>
        </div>
    </div>
</div>