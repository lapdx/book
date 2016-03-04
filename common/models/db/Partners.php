<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "partners".
 *
 * @property integer $id
 * @property string $website
 * @property integer $position
 * @property integer $active
 * @property string $email
 * @property integer $home
 * @property string $phone
 */
class Partners extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'partners';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['website'], 'required'],
            [['position', 'active', 'home'], 'integer'],
            [['website', 'name'], 'string', 'max' => 220],
            [['email'], 'email'],
            [['phone'], 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'website' => Yii::t('app', 'Website'),
            'position' => Yii::t('app', 'Position'),
            'active' => Yii::t('app', 'Active'),
            'home' => Yii::t('app', 'Home'),
        ];
    }

    public function attributes() {
        return array_merge(parent::attributes(), ['images']);
    }

}
