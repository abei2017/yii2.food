<?php

use yii\db\Migration;

class m180402_100600_add_preferential_column_in_order_table extends Migration
{
    public function safeUp()
    {
        $this->addColumn("{{%order}}",'preferential_money',$this->decimal(10,2)->notNull()->defaultValue(0.00));

    }

    public function safeDown()
    {
        echo "m180402_100600_add_preferential_column_in_order_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180402_100600_add_preferential_column_in_order_table cannot be reverted.\n";

        return false;
    }
    */
}
