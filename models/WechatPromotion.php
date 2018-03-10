<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "food_wechat_promotion".
 *
 * @property integer $id
 * @property integer $dish_id
 * @property string $price
 * @property integer $number
 * @property integer $state
 * @property integer $max_number
 * @property integer $created_at
 * @property integer $updated_at
 */
class WechatPromotion extends \yii\db\ActiveRecord
{

    public function behaviors(){
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
        return '{{%wechat_promotion}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dish_id'], 'required'],
            [['dish_id', 'number', 'state', 'max_number', 'created_at', 'updated_at'], 'integer'],
            [['price'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'dish_id' => '菜品',
            'price' => '特惠价',
            'number' => '特惠数量',
            'state' => '状态',
            'max_number' => '每单最多买',
            'created_at' => '生成时间',
            'updated_at' => '更新时间',
        ];
    }

    public function getDish(){
        return $this->hasOne(Dish::className(),['id'=>'dish_id']);
    }
}
