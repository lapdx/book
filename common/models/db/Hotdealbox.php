<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "hotdealbox".
 *
 * @property integer $id
 * @property integer $itemId
 * @property integer $active
 * @property string $type
 */
class Hotdealbox extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'hotdealbox';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['itemId', 'type'], 'required'],
            [['itemId', 'active'], 'integer'],
            [['type'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'itemId' => 'Item ID',
            'active' => 'Active',
            'type' => 'Type',
        ];
    }

    /**
     *
     * @return type
     */
    public function attributes() {
        return array_merge(parent::attributes(), ['item']);
    }
    public function getBook(){
        return Item::findOne(['id'=>$this->itemId]);
    }
    public static function getSelling(){
        return static::find()->where('type = "selling"')->limit(10)->all();
    }
    public static function getHot(){
        return static::find()->where('type = "hot"')->limit(10)->all();
    }
}
