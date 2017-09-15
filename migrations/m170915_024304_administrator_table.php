<?php

use yii\db\Migration;

class m170915_024304_administrator_table extends Migration
{
    public function safeUp()
    {
        $this->createTable("{{%administrator}}",[
            'id'=>$this->primaryKey(),
            'adminname'=>$this->string(32)->notNull()->comment('管理员名称'),
            'password'=>$this->string(32)->notNull()->comment('管理员密码'),

            'created_at'=>$this->integer(11)->notNull()->defaultValue(0)->comment('生成时间'),
            'updated_at'=>$this->integer(11)->notNull()->defaultValue(0)->comment('更新时间')
        ]);
    }

    public function safeDown()
    {
        echo "m170915_024304_administrator_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170915_024304_administrator_table cannot be reverted.\n";

        return false;
    }
    */
}
