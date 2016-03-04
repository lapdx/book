<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "banner".
 *
 * @property integer $id
 * @property string $name
 * @property integer $active
 * @property string $link
 * @property integer $position
 * @property string $type
 * @property string $description
 */
class Banner extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'banner';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['name', 'type'], 'required'],
            [['active', 'position'], 'integer'],
            [['name', 'link'], 'string', 'max' => 220],
            [['type'], 'string', 'max' => 10],
            [['description'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'active' => 'Active',
            'link' => 'Link',
            'position' => 'Position',
            'type' => 'Type',
            'description' => 'Description',
        ];
    }

    /**
     * 
     * @return type
     */
    public function attributes() {
        return array_merge(parent::attributes(), ['images']);
    }

}
