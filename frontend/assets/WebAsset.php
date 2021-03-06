<?php

namespace frontend\assets;

class WebAsset extends AppAsset {

    public $css = [
        'owl-carousel-2/assets/owl.carousel.css',
        'materialize/css/materialize.min.css',
        'css/style.css',
        'css/custom.css',
    ];
    public $js = [
        'js/jquery.min.js',
        'js/main.js',
        'owl-carousel-2/owl.carousel.min.js',
        'materialize/js/materialize.min.js',
    ];
    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];

}
