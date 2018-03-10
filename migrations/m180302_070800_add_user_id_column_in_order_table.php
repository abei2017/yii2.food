<?php

use yii\db\Migration;

class m180302_070800_add_user_id_column_in_order_table extends Migration
{
    public function safeUp()
    {

        $this->addColumn("{{%order}}","user_id",$this->integer(11)->null()->defaultValue(0));
    }

    public function safeDown()
    {
        echo "m180302_070800_add_user_id_column_in_order_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180302_070800_add_user_id_column_in_order_table cannot be reverted.\n";

        return false;
    }
    */
}
