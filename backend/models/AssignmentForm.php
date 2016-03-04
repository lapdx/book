<?php

namespace backend\models;

use common\models\business\FunctionBusiness;
use common\models\output\Response;
use yii\base\Model;
use yii\rbac\DbManager;

class AssignmentForm extends Model {

    public $userId;
    public $roles;

    public function rules() {
        return [
            [['userId', 'roles'], 'string'],
        ];
    }

    public function save() {
        FunctionBusiness::removeAssignmentByUserId($this->userId);
        $dbManager = new DbManager();
        $dbManager->init();
        foreach ($this->roles as $role) {
            $assignment = $dbManager->getAssignment($role, $this->userId);
            if ($assignment == null) {
                $dbManager->assign($dbManager->getPermission($role), $this->userId);
            }
        }
        return new Response(true, "Assign role admin " . $this->userId . " success", $this->roles);
    }

}
