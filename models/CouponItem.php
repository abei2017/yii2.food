<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "food_coupon_item".
 *
 * @property integer $id
 * @property string $number
 * @property integer $coupon_id
 * @property integer $user_id
 * @property integer $used_at
 * @property integer $order_id
 * @property integer $created_at
 * @property integer $updated_at
 */
class CouponItem extends \yii\db\ActiveRecord
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
        return '{{%coupon_item}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['number', 'coupon_id'], 'required'],
            [['coupon_id', 'user_id', 'used_at', 'order_id', 'created_at', 'updated_at'], 'integer'],
            [['number'], 'string', 'max' => 8],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'number' => 'Number',
            'coupon_id' => 'Coupon ID',
            'user_id' => 'User ID',
            'used_at' => 'Used At',
            'order_id' => 'Order ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
