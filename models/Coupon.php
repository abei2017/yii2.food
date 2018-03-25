<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "food_coupon".
 *
 * @property integer $id
 * @property string $name
 * @property integer $quantity
 * @property string $price
 * @property integer $begin_at
 * @property integer $end_at
 * @property integer $created_at
 * @property integer $updated_at
 */
class Coupon extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%coupon}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'quantity', 'price', 'begin_at'], 'required'],
            [['quantity', 'created_at', 'updated_at'], 'integer'],
            [['price'], 'number'],
            [['name'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '活动名称',
            'quantity' => '发放数量',
            'price' => '面值',
            'begin_at' => '开始时间',
            'end_at' => '结束时间',
            'created_at' => '记录生成时间',
            'updated_at' => '最近更新时间',
        ];
    }
}
