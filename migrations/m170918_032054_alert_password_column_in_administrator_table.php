<?php

use yii\db\Migration;

class m170918_032054_alert_password_column_in_administrator_table extends Migration
{
    public function safeUp()
    {
        $this->alterColumn("{{%administrator}}","password",$this->string(60));
    }

    public function safeDown()
    {
        echo "m170918_032054_alert_password_column_in_administrator_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170918_032054_alert_password_column_in_administrator_table cannot be reverted.\n";

        return false;
    }
    */
}
