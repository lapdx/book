<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "home".
 *
 * @property integer $id
 * @property string $facebook
 * @property string $google
 * @property string $youtube
 * @property string $twitter
 * @property string $phoneconsult
 * @property string $phonecare
 * @property string $address1
 * @property string $address2
 * @property string $address3
 * @property string $tel1
 * @property string $tel2
 * @property string $tel3
 * @property string $description1
 * @property string $description2
 * @property string $description3
 * @property string $time
 * @property string $skype
 * @property string $email
 */
class Home extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'home';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['facebook', 'google', 'youtube', 'twitter', 'address1', 'address2', 'address3', 'description1', 'description2', 'description3', 'email'], 'string', 'max' => 255],
            [['phoneconsult', 'phonecare', 'tel1', 'tel2', 'tel3', 'time', 'skype'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'facebook' => 'Facebook',
            'google' => 'Google',
            'youtube' => 'Youtube',
            'twitter' => 'Twitter',
            'phoneconsult' => 'Phoneconsult',
            'phonecare' => 'Phonecare',
            'address1' => 'Address1',
            'address2' => 'Address2',
            'address3' => 'Address3',
            'tel1' => 'Tel1',
            'tel2' => 'Tel2',
            'tel3' => 'Tel3',
            'description1' => 'Description1',
            'description2' => 'Description2',
            'description3' => 'Description3',
            'time' => 'Time',
            'skype' => 'Skype',
            'email' => 'Email',
        ];
    }
     public function attributes() {
        return array_merge(parent::attributes(), ['logo']);
    }
}
