<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "food_order_upoff".
 *
 * @property integer $id
 * @property integer $order_id
 * @property integer $created_at
 * @property string $money
 * @property string $info
 * @property integer $ok_at
 */
class OrderUpoff extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%order_upoff}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'created_at', 'money', 'info'], 'required'],
            [['order_id', 'created_at', 'ok_at'], 'integer'],
            [['money'], 'number'],
            [['info'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => '订单ID',
            'created_at' => '生成时间',
            'money' => '优惠金额',
            'info' => '满减信息',
            'ok_at' => '确定时间',
        ];
    }
}
