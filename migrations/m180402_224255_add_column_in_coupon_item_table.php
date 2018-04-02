<?php

use yii\db\Migration;

class m180402_224255_add_column_in_coupon_item_table extends Migration
{
    public function safeUp()
    {
        return $this->addColumn("{{%coupon_item}}",'used_money',$this->decimal(10,2)->defaultValue(0.00));
    }

    public function safeDown()
    {
        echo "m180402_224255_add_column_in_coupon_item_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180402_224255_add_column_in_coupon_item_table cannot be reverted.\n";

        return false;
    }
    */
}
