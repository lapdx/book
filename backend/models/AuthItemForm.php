<?php

namespace backend\models;

use common\models\business\FunctionBusiness;
use common\models\db\AuthItem;
use common\models\db\AuthItemChild;
use common\models\output\Response;
use yii\base\Model;

class AuthItemForm extends Model {

    public $id;
    public $name;
    public $alias;
    public $type;
    public $groupId;

    public function rules() {
        return [
            [['alias', 'name'], 'string'],
            [['id', 'groupId', 'type'], 'integer'],
        ];
    }

    public function save() {
        $authItem = FunctionBusiness::getAuthItemByName($this->name);
        if ($authItem == null) {
            $authItem = new AuthItem();
            $authItem->name = $this->name;
            $authItem->type = $this->type;
            $authItem->description = "create By system admin";
            $authItem->created_at = time();
        }
        $authItem->updated_at = time();
        $authItem->alias = $this->alias;
        $authItem->groupId = $this->groupId;
        if (!$authItem->save()) {
            return new Response(false, "Incorrect data", $authItem->errors);
        }
        $par = explode("_", $authItem->name)[0];
        if (strpos($authItem->name, "_") && FunctionBusiness::getAuthItemChildsByPrimarykey($par, $authItem->name) == null) {
            $authItemChild = new AuthItemChild();
            $authItemChild->parent = $par;
            $authItemChild->child = $authItem->name;
            $authItemChild->save();
        }
        return new Response(true, "Save " . $authItem->alias . " success", $authItem);
    }

}
