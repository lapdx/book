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
 * @property string $createEmail
 * @property integer $updateTime
 * @property string $updateEmail
 * @property string $description
 * @property string $detail
 * @property integer $active
 * @property string $categoryName
 * @property integer $viewCount
 * @property integer $home
 * @property integer $footer
 * @property string $icon
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
            [['alias', 'name', 'categoryId', 'createEmail', 'updateEmail', 'detail', 'categoryName'], 'required'],
            [['categoryId', 'createTime', 'updateTime', 'active', 'viewCount', 'home','footer'], 'integer'],
            [['description', 'detail'], 'string'],
            [['alias', 'name', 'createEmail', 'updateEmail', 'categoryName', 'icon'], 'string', 'max' => 220],
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
            'createEmail' => Yii::t('app', 'Create Email'),
            'updateTime' => Yii::t('app', 'Update Time'),
            'updateEmail' => Yii::t('app', 'Update Email'),
            'description' => Yii::t('app', 'Description'),
            'detail' => Yii::t('app', 'Detail'),
            'active' => Yii::t('app', 'Active'),
            'categoryName' => Yii::t('app', 'Category Name'),
            'viewCount' => Yii::t('app', 'View Count'),
            'nav' => Yii::t('app', 'Nav'),
            'icon' => Yii::t('app', 'Icon'),
        ];
    }

    public function attributes() {
        return array_merge(parent::attributes(), ['images']);
    }

}
