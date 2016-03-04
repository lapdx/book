<?php

namespace backend\controllers;

use yii\web\Controller;

class BaseController extends Controller {

    public $staticClient;
    public $baseUrl;
    public $var;

    public function init() {
        parent::init();
        $this->baseUrl = 'http://' . $_SERVER['HTTP_HOST'] . str_replace("index.php", '', $_SERVER['SCRIPT_NAME']);
    }

}
