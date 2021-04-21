<?php

use yii\db\Migration;

/**
 * Class m210421_093428_create_table_inventory
 */
class m210421_093428_create_table_inventory extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(
            'inventory',
            array(
                'id' => $this->primaryKey(),
                'name' => $this->string()->notNull(),
                'serial' => $this->string(),
                'number' => $this->string(),
                'quantity' => $this->integer(),
                'sum' => $this->decimal(2),
                'space_id' => $this->integer()->notNull(),
                'date_created' => $this->dateTime(),
                'date_updated' => $this->dateTime()
            )
        );

        $this->createIndex(
            'fk_inventory_space_id_idx',
            'inventory',
            'space_id'
        );

        $this->addForeignKey(
            'fk_inventory_space_id_id1',
            'inventory',
            'space_id',
            'space',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('inventory');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210421_093428_create_table_inventory cannot be reverted.\n";

        return false;
    }
    */
}
