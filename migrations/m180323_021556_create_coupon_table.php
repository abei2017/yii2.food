<?php

use yii\db\Migration;

/**
 * Handles the creation of table `coupon`.
 */
class m180323_021556_create_coupon_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%coupon}}', [
            'id' => $this->primaryKey(),
            'name'=>$this->string(32)->notNull(),
            'quantity'=>$this->integer(4)->notNull(),
            'price'=>$this->decimal(10,2)->notNull(),
            'begin_at'=>$this->integer(11)->notNull(),
            'end_at'=>$this->integer(11)->notNull()->defaultValue(0),
            'created_at'=>$this->integer(11)->notNull(),
            'updated_at'=>$this->integer(11)->notNull()->defaultValue(0)
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('coupon');
    }
}
