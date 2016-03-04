<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "news_category".
 *
 * @property integer $id
 * @property string $alias
 * @property string $name
 * @property string $description
 * @property integer $parentId
 * @property integer $active
 * @property integer $position
 * @property integer $createTime
 * @property integer $updateTime
 * @property string $createEmail
 * @property string $updateEmail
 * @property integer $menu
 */
class NewsCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'news_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['alias', 'name', 'description', 'createEmail', 'updateEmail'], 'required'],
            [['description'], 'string'],
            [['parentId', 'active', 'position', 'createTime', 'updateTime', 'menu'], 'integer'],
            [['alias', 'name'], 'string', 'max' => 220],
            [['createEmail', 'updateEmail'], 'string', 'max' => 100],
            [['alias'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'alias' => 'Alias',
            'name' => 'Name',
            'description' => 'Description',
            'parentId' => 'Parent ID',
            'active' => 'Active',
            'position' => 'Position',
            'createTime' => 'Create Time',
            'updateTime' => 'Update Time',
            'createEmail' => 'Create Email',
            'updateEmail' => 'Update Email',
            'menu' => 'Menu',
        ];
    }
}
