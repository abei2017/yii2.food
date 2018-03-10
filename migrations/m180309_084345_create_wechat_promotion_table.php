<?php

use yii\db\Migration;

/**
 * Handles the creation of table `wechat_promotion`.
 */
class m180309_084345_create_wechat_promotion_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%wechat_promotion}}', [
            'id' => $this->primaryKey(),
            'dish_id'=>$this->integer(11)->notNull(),
            'price'=>$this->decimal(10,2)->notNull()->defaultValue(0.00),
            'number'=>$this->integer(4)->notNull()->defaultValue(0),
            'state'=>$this->integer(1)->notNull()->defaultValue(0),
            'max_number'=>$this->integer(4)->notNull()->defaultValue(0),

            'created_at'=>$this->integer(11)->notNull(),
            'updated_at'=>$this->integer(11)->notNull()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('wechat_promotion');
    }
}
