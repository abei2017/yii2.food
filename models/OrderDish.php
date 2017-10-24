<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%order_dish}}".
 *
 * @property integer $id
 * @property integer $order_id
 * @property integer $dish_id
 * @property string $money
 * @property integer $quantity
 * @property string $price
 * @property integer $created_at
 */
class OrderDish extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%order_dish}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'dish_id', 'quantity', 'created_at'], 'integer'],
            [['money', 'price'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => 'Order ID',
            'dish_id' => 'Dish ID',
            'money' => 'Money',
            'quantity' => 'Quantity',
            'price' => 'Price',
            'created_at' => 'Created At',
        ];
    }

    public function getDish(){
        return $this->hasOne(Dish::className(),['id'=>'dish_id']);
    }
}
