<?php

namespace backend\models;

use yii\base\Model;

class UploadForm extends Model {

    public $id;
    public $imageFile;
    public $url;

    public function rules() {
        return [
            [['id'], 'integer'],
            [['url'], 'string'],
            [['imageFile'], 'file'],
        ];
    }

}
