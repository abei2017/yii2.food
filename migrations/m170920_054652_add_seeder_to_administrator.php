<?php

use yii\db\Migration;

class m170920_054652_add_seeder_to_administrator extends Migration
{
    public function safeUp()
    {
        $this->insert("{{%administrator}}",[
            'adminname'=>'admin',
            'password'=>Yii::$app->security->generatePasswordHash("123456"),
            'created_at'=>time(),
            'updated_at'=>time(),
        ]);
    }

    public function safeDown()
    {
        echo "m170920_054652_add_seeder_to_administrator cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170920_054652_add_seeder_to_administrator cannot be reverted.\n";

        return false;
    }
    */
}
