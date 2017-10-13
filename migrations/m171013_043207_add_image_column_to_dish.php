<?php

use yii\db\Migration;

class m171013_043207_add_image_column_to_dish extends Migration
{
    public function safeUp()
    {
        $this->addColumn("{{%dish}}",'image',$this->string(64)->null()->comment('菜品图片'));
    }

    public function safeDown()
    {
        echo "m171013_043207_add_image_column_to_dish cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171013_043207_add_image_column_to_dish cannot be reverted.\n";

        return false;
    }
    */
}
