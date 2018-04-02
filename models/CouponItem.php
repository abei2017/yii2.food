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
            [['number'], 'unique'],
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
            'used_money'=>'使用金额'
        ];
    }

    static public function initCouponItems($couponId){
        $coupon = Coupon::findOne($couponId);
        if($coupon == false){
            return false;
        }

        $currentTotal = CouponItem::find()->where(['coupon_id'=>$couponId])->count();
        while ($currentTotal < $coupon->quantity){
            $number = Yii::$app->security->generateRandomString(8);
            $check = CouponItem::find()->where(['number'=>$number])->one();
            if($check){
                continue;
            }

            //add
            $new = new CouponItem();
            $new->number = $number;
            $new->coupon_id = $couponId;
            $new->user_id = $new->used_at = 0;
            if($new->save()){
                $currentTotal++;
            }
        }
    }

    public function getCoupon(){
        return $this->hasOne(Coupon::className(),['id'=>'coupon_id']);
    }
}
