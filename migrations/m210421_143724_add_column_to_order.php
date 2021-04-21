<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m210421_143724_add_column_to_order
 */
class m210421_143724_add_column_to_order extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('order', 'stock_id',Schema::TYPE_INTEGER);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210421_143724_add_column_to_order cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210421_143724_add_column_to_order cannot be reverted.\n";

        return false;
    }
    */
}
