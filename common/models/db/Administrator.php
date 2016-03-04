<?php

namespace common\models\db;

use common\models\input\AdministratorSearch;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "administrator".
 *
 * @property string $id
 * @property string $description
 * @property integer $joinTime
 * @property integer $active
 * @property integer $lastTime
 * @property integer $role
 * @property string $rememberKey
 */
class Administrator extends ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'administrator';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id'], 'required'],
            [['description'], 'string'],
            [['joinTime', 'active', 'lastTime', 'role'], 'integer'],
            [['id'], 'string', 'max' => 100],
            [['rememberKey'], 'string', 'max' => 32],
            [['id', 'active', 'rememberKey'], 'unique', 'targetAttribute' => ['id', 'active', 'rememberKey'], 'message' => 'The combination of Email, Active and Remember Key has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'Email'),
            'description' => Yii::t('app', 'Description'),
            'joinTime' => Yii::t('app', 'JoinTime'),
            'active' => Yii::t('app', 'Trạng thái'),
            'lastTime' => Yii::t('app', 'LastTime'),
            'role' => Yii::t('app', 'Role'),
            'rememberKey' => Yii::t('app', 'RememberKey'),
        ];
    }

    public static function search(AdministratorSearch $search) {
        $query = Administrator::find();
        if ($search->email != null && $search->email != '') {
            $query->andWhere(['LIKE', 'id', strtolower($search->email)]);
        }
        if ($search->active > 0) {
            $query->andWhere(['=', 'active', $search->active == 1]);
        }
        return $query;
    }

}
