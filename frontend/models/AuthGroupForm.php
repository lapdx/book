<?php

namespace backend\models;

use common\models\business\FunctionBusiness;
use common\models\db\AuthItemGroup;
use common\models\output\Response;
use yii\base\Model;

class AuthGroupForm extends Model {

    public $id;
    public $name;
    public $position;

    public function rules() {
        return [
            [['name'], 'string'],
            [['id', 'position'], 'integer'],
        ];
    }

    public function save() {
        $authItemGroup = FunctionBusiness::getAuthGroupById($this->id);
        if ($authItemGroup == null) {
            $authItemGroup = new AuthItemGroup();
        }
        $authItemGroup->name = $this->name;
        $authItemGroup->position = $this->position;
        if (!$authItemGroup->save()) {
            return new Response(false, "Incorrect data", $authItemGroup->errors);
        }
        return new Response(true, "Save " . $authItemGroup->name . " success", $authItemGroup);
    }

}
