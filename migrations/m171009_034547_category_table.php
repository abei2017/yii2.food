<?php

use yii\db\Migration;

class m171009_034547_category_table extends Migration
{
    public function safeUp()
    {
        $this->createTable("{{%category}}",[
            'id'=>$this->primaryKey(),
            'name'=>$this->string(32)->notNull()->comment('分类名字'),
            'fid'=>$this->integer(11)->notNull()->defaultValue(0)->comment('父级ID'),

            'created_at'=>$this->integer(11)->notNull()->defaultValue(0)->comment('生成时间'),
            'updated_at'=>$this->integer(11)->notNull()->defaultValue(0)->comment('更新时间')
        ]);
    }

    public function safeDown()
    {
        echo "m171009_034547_category_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171009_034547_category_table cannot be reverted.\n";

        return false;
    }
    */
}
