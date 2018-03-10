<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user`.
 */
class m180302_070739_create_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'open_id'=>$this->string(32)->notNull(),
            'created_at'=>$this->integer(11)->notNull(),
            'info'=>$this->text()->null(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('user');
    }
}
