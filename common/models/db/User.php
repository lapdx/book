<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property string $id
 * @property string $description
 * @property integer $joinTime
 * @property integer $active
 * @property integer $lastTime
 * @property integer $role
 * @property string $rememberKey
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['description'], 'string'],
            [['joinTime', 'active', 'lastTime', 'role'], 'integer'],
            [['id'], 'string', 'max' => 100],
            [['rememberKey'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'description' => 'Description',
            'joinTime' => 'Join Time',
            'active' => 'Active',
            'lastTime' => 'Last Time',
            'role' => 'Role',
            'rememberKey' => 'Remember Key',
        ];
    }
}
