<?php

use yii\db\Migration;

/**
 * Handles the creation of table `coupon_item`.
 */
class m180323_021600_create_coupon_item_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%coupon_item}}', [
            'id' => $this->primaryKey(),
            'number'=>$this->string(8)->notNull(),
            'coupon_id'=>$this->integer(11)->notNull(),
            'user_id'=>$this->integer(11)->notNull()->defaultValue(0),
            'used_at'=>$this->integer(11)->notNull()->defaultValue(0),
            'order_id'=>$this->integer(11)->notNull()->defaultValue(0),

            'created_at'=>$this->integer(11)->notNull(),
            'updated_at'=>$this->integer(11)->notNull()->defaultValue(0)
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('coupon_item');
    }
}
