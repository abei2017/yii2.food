<?php

use yii\db\Migration;

class m171012_111418_category_seeder extends Migration
{
    public function safeUp()
    {
        $this->batchInsert("{{%category}}",['id','name','fid','created_at','updated_at'],[
            [1,'主食',0,time(),time()],
            [2,'小菜',0,time(),time()],
        ]);

        $this->batchInsert("{{%category}}",['id','name','fid','created_at','updated_at'],[
            [3,'面食',1,time(),time()],
            [4,'凉菜',2,time(),time()],
            [5,'热菜',2,time(),time()],
        ]);
    }

    public function safeDown()
    {
        echo "m171012_111418_category_seeder cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171012_111418_category_seeder cannot be reverted.\n";

        return false;
    }
    */
}
