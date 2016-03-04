<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "order_info".
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $address
 * @property string $phone
 * @property string $paymentMethod
 * @property string $note
 * @property double $totalPrice
 * @property string $buyerId
 * @property integer $createTime
 * @property integer $remove
 * @property integer $updateTime
 */
class OrderInfo extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'order_info';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['name', 'email', 'address', 'phone', 'paymentMethod', 'note'], 'required'],
            [['totalPrice'], 'number'],
            [['createTime', 'remove', 'updateTime'], 'integer'],
            [['name', 'email', 'address'], 'string', 'max' => 255],
            [['phone','buyerId'], 'string', 'max' => 100],
            [['paymentMethod'], 'string', 'max' => 10],
            [['note'], 'string', 'max' => 500]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'address' => 'Address',
            'phone' => 'Phone',
            'paymentMethod' => 'Payment Method',
            'note' => 'Note',
            'totalPrice' => 'Total Price',
            'buyerId' => 'Buyer ID',
            'createTime' => 'Create Time',
            'remove' => 'Remove',
            'updateTime' => 'Update Time',
        ];
    }

    public function attributes() {
        return array_merge(parent::attributes(), ['items']);
    }

}
