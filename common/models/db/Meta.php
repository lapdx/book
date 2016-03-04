<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "meta".
 *
 * @property integer $id
 * @property string $type
 * @property string $objectId
 * @property string $title
 * @property string $description
 * @property string $keyword
 */
class Meta extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'meta';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'objectId'], 'required'],
            [['type', 'objectId'], 'string', 'max' => 50],
            [['title', 'description', 'keyword'], 'string', 'max' => 500]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'objectId' => 'Object ID',
            'title' => 'Title',
            'description' => 'Description',
            'keyword' => 'Keyword',
        ];
    }
}
