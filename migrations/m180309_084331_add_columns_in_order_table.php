<?php

use yii\db\Migration;

class m180309_084331_add_columns_in_order_table extends Migration
{
    public function safeUp()
    {
        $this->addColumn("{{%order}}","type",$this->string(8)->notNull()->defaultValue("normal"));
        $this->addColumn("{{%order}}","type_str",$this->string(32)->null());
    }

    public function safeDown()
    {
        echo "m180309_084331_add_columns_in_order_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180309_084331_add_columns_in_order_table cannot be reverted.\n";

        return false;
    }
    */
}
