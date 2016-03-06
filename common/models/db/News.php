<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "news".
 *
 * @property integer $id
 * @property string $alias
 * @property string $name
 * @property integer $categoryId
 * @property integer $createTime
 * @property integer $updateTime
 * @property string $description
 * @property string $detail
 * @property integer $active
 * @property string $categoryName
 */
class News extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'news';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['alias', 'name', 'categoryId', 'detail', 'categoryName'], 'required'],
            [['categoryId', 'createTime', 'updateTime', 'active'], 'integer'],
            [['description', 'detail'], 'string'],
            [['alias', 'name', 'categoryName'], 'string', 'max' => 220],
            [['alias'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'alias' => Yii::t('app', 'Alias'),
            'name' => Yii::t('app', 'Name'),
            'categoryId' => Yii::t('app', 'Category ID'),
            'createTime' => Yii::t('app', 'Create Time'),
            'updateTime' => Yii::t('app', 'Update Time'),
            'description' => Yii::t('app', 'Description'),
            'detail' => Yii::t('app', 'Detail'),
            'active' => Yii::t('app', 'Active'),
            'categoryName' => Yii::t('app', 'Category Name'),
        ];
    }

    public function attributes() {
        return array_merge(parent::attributes(), ['images']);
    }

}
