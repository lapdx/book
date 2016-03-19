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
 * @property string $categoryName
 * @property integer $createTime
 * @property integer $updateTime
 * @property string $author
 */
class Item extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        [['name', 'sellPrice', 'startPrice', 'active', 'categoryId'], 'required'],
        [['sellPrice', 'startPrice'], 'number'],
        [['active', 'categoryId', 'createTime', 'updateTime'], 'integer'],
        [['content'], 'string'],
        [['name', 'categoryName'], 'string', 'max' => 255],
        [['description'], 'string', 'max' => 500],
        [['author'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
        'id' => 'ID',
        'name' => 'Name',
        'sellPrice' => 'Sell Price',
        'startPrice' => 'Start Price',
        'active' => 'Active',
        'description' => 'Description',
        'content' => 'Content',
        'categoryId' => 'Category ID',
        'categoryName' => 'Category Name',
        'createTime' => 'Create Time',
        'updateTime' => 'Update Time',
        'author' => 'Author',
        ];
    }

    public function attributes() {
        return array_merge(parent::attributes(), ['images']);
    }

    public function getAllImages(){
        return Image::findAll(['targetId'=>$this->id]);
    }
    public function getCategory(){
        return $this->hasOne(Category::className(), ['id' => 'categoryId']); 
    }
    public function getThumbnailImageUrl(){
        $image = Image::findOne(['targetId'=>$this->id]);
        if($image) return $image->imageId;
        else return 'images/toi-tai-gioi-ban-cung-the-2--1-.jpg';
    }
}