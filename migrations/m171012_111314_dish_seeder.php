<?php

use yii\db\Migration;

class m171012_111314_dish_seeder extends Migration
{
    public function safeUp()
    {
        $this->batchInsert("{{%dish}}",['id','title','price','cat_id','small_cat_id','created_at','updated_at'],[
            [1,'担担面',7.00,1,3,time(),time()],
            [2,'砂锅面',7.50,1,3,time(),time()],
            [3,'大拉皮',8.00,2,4,time(),time()],
            [4,'溜肉段',15.00,2,5,time(),time()],
        ]);
    }

    public function safeDown()
    {
        echo "m171012_111314_dish_seeder cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171012_111314_dish_seeder cannot be reverted.\n";

        return false;
    }
    */
}
