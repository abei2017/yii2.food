<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%order}}".
 *
 * @property integer $id
 * @property string $pay_id
 * @property string $state
 * @property integer $created_at
 * @property string $money
 * @property integer $quantity
 * @property integer $paid_at
 * @property string $transaction_id
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%order}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'quantity', 'paid_at'], 'integer'],
            [['money'], 'number'],
            [['pay_id'], 'string', 'max' => 32],
            [['state'], 'string', 'max' => 8],
            [['transaction_id'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pay_id' => 'Pay ID',//o-id-xxx
            'state' => 'State',
            'created_at' => 'Created At',
            'money' => '订单总额',
            'quantity' => '购买数量',
            'paid_at' => 'Paid At',
            'transaction_id' => 'Transaction ID',
        ];
    }

    public function getDishes(){
        return $this->hasMany(OrderDish::className(),['order_id'=>'id']);
    }

    public function stateTxt(){
        $arr = [
            'unpay'=>'未付款',
            'pay'=>'已付款',
            'fail'=>'失败订单',
            'close'=>'已经关闭订单',
        ];

        return $arr[$this->state];
    }
}
