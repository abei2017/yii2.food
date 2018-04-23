<?php

use yii\db\Migration;

class m180423_061409_add_pay_type_column_in_order_table extends Migration
{
    public function safeUp()
    {
        $this->addColumn("{{%order}}","pay_type",$this->string(8)->notNull()->defaultValue('wx'));
    }

    public function safeDown()
    {
        echo "m180423_061409_add_pay_type_column_in_order_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180423_061409_add_pay_type_column_in_order_table cannot be reverted.\n";

        return false;
    }
    */
}
