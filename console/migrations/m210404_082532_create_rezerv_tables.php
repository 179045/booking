<?php

use yii\db\Migration;

/**
 * Class m210404_082532_create_rezerv_tables
 */
class m210404_082532_create_rezerv_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(
            'time',
            array(
                'id' => $this->primaryKey(),
                'name' => $this->string(),
                'is_del' => $this->boolean()
            )
        );

        $this->createTable(
            'status_reserve',
            array(
                'id' => $this->primaryKey(),
                'name' => $this->string(),
                'is_del' => $this->boolean()
            )
        );

        $this->createTable(
            'reserve',
            array(
                'id' => $this->primaryKey(),
                'date' => $this->date()->notNull(),
                'time_id' => $this->integer()->notNull(),
                'customer_id' => $this->integer()->notNull(),
                'space_id' => $this->integer()->notNull(),
                'place_id' => $this->integer(),
                'count_person' => $this->integer(),
                'count_person_fact' => $this->integer(),
                'prepay' => $this->integer(),
                'note' => $this->string(),
                'is_fact' => $this->boolean(),
                'is_waiting' => $this->boolean(),
                'status_id' => $this->integer()->notNull()
            )
        );

        $this->createIndex(
            'fk_reserve_time_idx',
            'reserve',
            'time_id'
        );

        $this->addForeignKey(
            'fk_reserve_time_idx',
            'reserve',
            'time_id',
            'time',
            'id'
        );

        $this->createIndex(
            'fk_reserve_customer_idx',
            'reserve',
            'customer_id'
        );

        $this->addForeignKey(
            'fk_reserve_customer_idx',
            'reserve',
            'customer_id',
            'customer',
            'id'
        );

        $this->createIndex(
            'fk_reserve_place_idx',
            'reserve',
            'place_id'
        );

        $this->addForeignKey(
            'fk_reserve_place_idx',
            'reserve',
            'place_id',
            'place',
            'id'
        );

        $this->createIndex(
            'fk_reserve_space_idx',
            'reserve',
            'space_id'
        );

        $this->addForeignKey(
            'fk_reserve_space_idx',
            'reserve',
            'space_id',
            'space',
            'id'
        );

        $this->createIndex(
            'fk_reserve_status_idx',
            'reserve',
            'status_id'
        );

        $this->addForeignKey(
            'fk_reserve_status_idx',
            'reserve',
            'status_id',
            'status_reserve',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210404_082532_create_rezerv_tables cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210404_082532_create_rezerv_tables cannot be reverted.\n";

        return false;
    }
    */
}
