<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%dish}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $price
 * @property integer $cat_id
 * @property integer $small_cat_id
 * @property integer $created_at
 * @property integer $updated_at
 */
class Dish extends \yii\db\ActiveRecord
{

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%dish}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'cat_id', 'small_cat_id'], 'required'],
            [['price'], 'number'],
            [['cat_id', 'small_cat_id', 'created_at', 'updated_at'], 'integer'],
            [['title'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '菜品标题',
            'price' => '菜品价格',
            'cat_id' => '所属大类',
            'small_cat_id' => '所属小类',
            'created_at' => '生成时间',
            'updated_at' => '更新时间',
            'image'=>'菜品头图',
        ];
    }

    public function getCat(){
        return $this->hasOne(Category::className(),['id'=>'cat_id']);
    }
}
