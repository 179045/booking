<?php

use yii\db\Migration;

/**
 * Class m210427_085152_alter_column_inventory
 */
class m210427_085152_alter_column_inventory extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('inventory', 'sum', $this->decimal(13, 4));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('inventory', 'sum', $this->decimal(2, 0));
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210427_085152_alter_column_inventory cannot be reverted.\n";

        return false;
    }
    */
}
