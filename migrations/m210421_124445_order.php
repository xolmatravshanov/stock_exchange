<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m210421_124445_order
 */
class m210421_124445_order extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->createTable('order', [
            'id' => Schema::TYPE_PK,
            'type' => Schema::TYPE_STRING . ' NOT NULL',
            'amount' => Schema::TYPE_INTEGER . ' NOT NULL',
            'price' => Schema::TYPE_FLOAT. ' NOT NULL',
            'customer_id' => Schema::TYPE_INTEGER. ' NOT NULL',
            'created_at' => Schema::TYPE_DATETIME. ' NOT NULL',
            'updated_at' => Schema::TYPE_DATETIME. ' NOT NULL',
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('order');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210421_124445_order cannot be reverted.\n";

        return false;
    }
    */
}
