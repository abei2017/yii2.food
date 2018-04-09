<?php

use yii\db\Migration;

/**
 * Handles the creation of table `order_upoff`.
 */
class m180409_082726_create_order_upoff_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%order_upoff}}', [
            'id' => $this->primaryKey(),
            'order_id'=>$this->integer(11)->notNull(),
            'created_at'=>$this->integer(11)->notNull(),
            'money'=>$this->decimal(10,2)->notNull(),
            'info'=>$this->text()->notNull(),

            'ok_at'=>$this->integer(11)->notNull()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('order_upoff');
    }
}
