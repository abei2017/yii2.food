<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "food_user".
 *
 * @property integer $id
 * @property string $open_id
 * @property integer $created_at
 * @property string $info
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['open_id', 'created_at'], 'required'],
            [['created_at'], 'integer'],
            [['info'], 'string'],
            [['open_id'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'open_id' => 'Open ID',
            'created_at' => 'Created At',
            'info' => 'Info',
        ];
    }
}
