<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m210421_132136_transaction
 */
class m210421_132136_transaction extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('transaction', [
            'id' => Schema::TYPE_PK,
            'seller_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'buyer_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'amount' => Schema::TYPE_INTEGER. ' NOT NULL',
            'price' => Schema::TYPE_FLOAT. ' NOT NULL',
            'created_at' => Schema::TYPE_DATETIME. ' NOT NULL',
            'updated_at' => Schema::TYPE_DATETIME. ' NOT NULL',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $this->dropTable('transaction');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210421_132136_transaction cannot be reverted.\n";

        return false;
    }
    */
}
