<?php

use yii\db\Migration;

class m171017_071749_order_dish_table extends Migration
{
    public function safeUp()
    {
        $this->createTable("{{%order_dish}}",[
            'id'=>$this->primaryKey(),
            'order_id'=>$this->integer(11)->notNull()->defaultValue(0)->comment('订单ID'),
            'dish_id'=>$this->integer(11)->notNull()->defaultValue(0)->comment('菜品ID'),
            'money'=>$this->decimal(10,2)->notNull()->defaultValue(0.00)->comment('购买金额'),
            'quantity'=>$this->integer(11)->notNull()->defaultValue(0)->comment('购买数量'),
            'price'=>$this->decimal(10,2)->notNull()->defaultValue(0.00)->comment('菜品单价'),
            'created_at'=>$this->integer(11)->notNull()->defaultValue(0)->comment('购买时间')
        ]);
    }

    public function safeDown()
    {
        echo "m171017_071749_order_dish_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171017_071749_order_dish_table cannot be reverted.\n";

        return false;
    }
    */
}
