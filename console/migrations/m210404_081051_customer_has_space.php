<?php

use yii\db\Migration;

/**
 * Class m210404_081051_customer_has_space
 */
class m210404_081051_customer_has_space extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(
            'customer_has_space', [
            'customer_id' => $this->integer()->notNull(),
            'space_id' => $this->integer()->notNull(),
            'rating' => $this->integer(),
            'type_customer_id' => $this->integer(),
        ]);

        $this->addPrimaryKey(
            'customer_has_space_pk',
            'customer_has_space',
            [
                'customer_id',
                'space_id'
            ]
        );

        $this->createIndex(
            'fk_customer_has_space_customer_idx',
            'customer_has_space',
            'customer_id'
        );

        $this->addForeignKey(
            'fk_customer_has_space_customer_id',
            'customer_has_space',
            'customer_id',
            'customer',
            'id'
        );

        $this->createIndex(
            'fk_customer_has_space_space_idx',
            'customer_has_space',
            'space_id'
        );

        $this->addForeignKey(
            'fk_customer_has_space_space_id',
            'customer_has_space',
            'space_id',
            'space',
            'id'
        );

        $this->createIndex(
            'fk_customer_has_space_type_customer_idx',
            'customer_has_space',
            'type_customer_id'
        );

        $this->addForeignKey(
            'fk_customer_has_space_type_customer_id',
            'customer_has_space',
            'type_customer_id',
            'type_customer',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210404_081051_customer_has_space cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210404_081051_customer_has_space cannot be reverted.\n";

        return false;
    }
    */
}
