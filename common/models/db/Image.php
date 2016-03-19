<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "image".
 *
 * @property string $targetId
 * @property integer $position
 * @property string $type
 * @property integer $width
 * @property integer $height
 * @property string $extension
 * @property string $imageId
 */
class Image extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'image';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['targetId', 'imageId'], 'required'],
            [['position', 'width', 'height'], 'integer'],
            [['targetId', 'imageId'], 'string', 'max' => 220],
            [['type'], 'string', 'max' => 20],
            [['extension'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'targetId' => Yii::t('app', 'Target ID'),
            'position' => Yii::t('app', 'Position'),
            'type' => Yii::t('app', 'Type'),
            'width' => Yii::t('app', 'Width'),
            'height' => Yii::t('app', 'Height'),
            'extension' => Yii::t('app', 'Extension'),
            'imageId' => Yii::t('app', 'Image ID'),
        ];
    }

    public function getItem(){
        return $this->hasOne(Item::className(), ['id' => 'targetId']); 
    }
}
