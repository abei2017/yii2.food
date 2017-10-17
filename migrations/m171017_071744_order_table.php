<?php

use yii\db\Migration;

class m171017_071744_order_table extends Migration
{
    public function safeUp()
    {
        $this->createTable("{{%order}}",[
            'id'=>$this->primaryKey(),
            'pay_id'=>$this->string(32)->null()->comment('商户编号'),
            'state'=>$this->string(8)->null()->comment('订单状态'),
            'created_at'=>$this->integer(11)->notNull()->defaultValue(0)->comment('订单生成时间'),
            'money'=>$this->decimal(10,2)->notNull()->defaultValue(0.00)->comment('订单总额'),
            'quantity'=>$this->integer(11)->notNull()->defaultValue(0)->comment('订单总量'),

            //  支付返回
            'paid_at'=>$this->integer(11)->notNull()->defaultValue(0)->comment('支付时间'),
            'transaction_id'=>$this->string(64)->null()->comment('平台交易流水号'),
        ]);
    }

    public function safeDown()
    {
        echo "m171017_071744_order_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171017_071744_order_table cannot be reverted.\n";

        return false;
    }
    */
}
