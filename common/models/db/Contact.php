<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "contact".
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $content
 * @property integer $createTime
 * @property integer $updateTime
 * @property string $phone
 * @property string $address
 */
class Contact extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contact';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'email', 'content'], 'required'],
            [['createTime', 'updateTime'], 'integer'],
            [['phone'], 'number'],
            [['name', 'email', 'content','address'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'content' => 'Content',
            'createTime' => 'Create Time',
            'updateTime' => 'Update Time',
        ];
    }
}
