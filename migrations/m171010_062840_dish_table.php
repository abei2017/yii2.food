<?php

use yii\db\Migration;

class m171010_062840_dish_table extends Migration
{
    public function safeUp()
    {
        $this->createTable("{{%dish}}",[
            'id'=>$this->primaryKey(),
            'title'=>$this->string(64)->notNull()->comment('菜品名称'),

            'price'=>$this->decimal(10,2)->notNull()->defaultValue(0.00)->comment('售价'),
            'cat_id'=>$this->integer(11)->notNull()->comment('分类ID'),
            'small_cat_id'=>$this->integer(11)->notNull()->comment('小分类ID'),

            'created_at'=>$this->integer(11)->notNull()->defaultValue(0)->comment('生成时间'),
            'updated_at'=>$this->integer(11)->notNull()->defaultValue(0)->comment('更新时间')
        ]);
    }

    public function safeDown()
    {
        echo "m171010_062840_dish_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171010_062840_dish_table cannot be reverted.\n";

        return false;
    }
    */
}
