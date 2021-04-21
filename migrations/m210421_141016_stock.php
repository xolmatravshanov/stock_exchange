<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m210421_141016_stock
 */
class m210421_141016_stock extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->createTable('stock', [
            'id' => Schema::TYPE_PK,
            'codec' => Schema::TYPE_STRING . ' NOT NULL',
            'name' => Schema::TYPE_STRING. ' NOT NULL',
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('stock');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210421_141016_stock cannot be reverted.\n";

        return false;
    }
    */
}
