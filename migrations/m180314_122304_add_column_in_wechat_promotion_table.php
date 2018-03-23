<?php

use yii\db\Migration;

class m180314_122304_add_column_in_wechat_promotion_table extends Migration
{
    public function safeUp()
    {
        $this->addColumn("{{%wechat_promotion}}","sold_number",$this->integer(4)->notNull()->defaultValue(0));
    }

    public function safeDown()
    {
        echo "m180314_122304_add_column_in_wechat_promotion_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180314_122304_add_column_in_wechat_promotion_table cannot be reverted.\n";

        return false;
    }
    */
}
