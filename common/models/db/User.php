<?php

namespace common\models\db;

use Yii;
use yii\web\IdentityInterface;

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
class User extends \yii\db\ActiveRecord implements IdentityInterface
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

    public static function findByUsername($username){
        return static::findOne(['username'=>$username]);
    }

    public static function hashPassword($password)
    {
        return Yii::$app->getSecurity()->generatePasswordHash($password);
    }

    public function validatePassword($password){
        return Yii::$app->getSecurity()->validatePassword($password, $this->password);
    }
    /**
     * Finds an identity by the given ID.
     *
     * @param string|integer $id the ID to be looked for
     * @return IdentityInterface|null the identity object that matches the given ID.
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * Finds an identity by the given token.
     *
     * @param string $token the token to be looked for
     * @return IdentityInterface|null the identity object that matches the given token.
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * @return int|string current user ID
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string current user auth key
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @param string $authKey
     * @return boolean if auth key is valid for current user
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }
}