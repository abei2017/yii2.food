<?php

namespace app\modules\admin\models;

use Yii;
use yii\web\IdentityInterface;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%administrator}}".
 *
 * @property integer $id
 * @property string $adminname
 * @property string $password
 * @property integer $created_at
 * @property integer $updated_at
 */
class Administrator extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%administrator}}';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['adminname'], 'required'],
            ['password','required'],
            [['created_at', 'updated_at'], 'integer'],
            [['adminname', 'password'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'adminname' => '管理员名称',
            'password' => 'Password',
            'created_at' => '生成时间',
            'updated_at' => '更新时间',
        ];
    }

    public function getId()
    {
        return $this->id;
    }

    public static function findIdentity($id)
    {
        return Administrator::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        //
    }

    public function getAuthKey()
    {
        // TODO: Implement getAuthKey() method.
    }

    public function validateAuthKey($authKey)
    {
        // TODO: Implement validateAuthKey() method.
    }
}
