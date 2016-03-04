<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "order_item".
 *
 * @property integer $id
 * @property integer $orderId
 * @property double $sellPrice
 * @property double $startPrice
 * @property string $name
 * @property integer $quantity
 * @property string $image
 * @property integer $sku
 */
class OrderItem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['orderId', 'sellPrice', 'startPrice', 'name', 'quantity', 'sku'], 'required'],
            [['orderId', 'quantity', 'sku'], 'integer'],
            [['sellPrice', 'startPrice'], 'number'],
            [['name'], 'string', 'max' => 255],
            [['image'], 'string', 'max' => 500]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'orderId' => 'Order ID',
            'sellPrice' => 'Sell Price',
            'startPrice' => 'Start Price',
            'name' => 'Name',
            'quantity' => 'Quantity',
            'image' => 'Image',
            'sku' => 'Sku',
        ];
    }
}
