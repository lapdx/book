<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "item".
 *
 * @property integer $id
 * @property string $name
 * @property double $sellPrice
 * @property double $startPrice
 * @property integer $active
 * @property string $description
 * @property string $content
 * @property integer $categoryId
 * @property integer $partnersId
 * @property integer $type
 * @property integer $power
 * @property integer $gift
 * @property string $origin
 * @property string $categoryName
 * @property integer $createTime
 * @property integer $updateTime
 */
class Item extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'item';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['name', 'sellPrice', 'startPrice', 'active', 'categoryId', 'partnersId', 'power', 'origin'], 'required'],
            [['sellPrice', 'startPrice'], 'number'],
            [['active', 'categoryId', 'partnersId', 'type','noise', 'power', 'createTime', 'updateTime'], 'integer'],
            [['content'], 'string'],
            [['name', 'description', 'origin', 'categoryName','gift'], 'string', 'max' => 500]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'sellPrice' => 'Sell Price',
            'startPrice' => 'Start Price',
            'active' => 'Active',
            'description' => 'Description',
            'content' => 'Content',
            'categoryId' => 'Category ID',
            'partnersId' => 'Partners ID',
            'type' => 'Type',
            'power' => 'Power',
            'origin' => 'Origin',
            'categoryName' => 'Category Name',
            'createTime' => 'Create Time',
            'updateTime' => 'Update Time',
        ];
    }

    public function attributes() {
        return array_merge(parent::attributes(), ['images']);
    }

}
