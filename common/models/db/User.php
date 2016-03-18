<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property integer $active
 * @property string $type
 * @property integer $role
 * @property string $email
 * @property string $fullname
 * @property string $phone
 */
class User extends \yii\db\ActiveRecord
{
    const TYPE_CUSTOMER = 'customer';
    const TYPE_ADMIN = 'admin';

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
            [['username'], 'required'],
            [['active', 'role'], 'integer'],
            [['username', 'password', 'email', 'fullname'], 'string', 'max' => 200],
            [['type'], 'string', 'max' => 50],
            [['phone'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'active' => 'Active',
            'type' => 'Type',
            'role' => 'Role',
            'email' => 'Email',
            'fullname' => 'Fullname',
        ];
    }
}