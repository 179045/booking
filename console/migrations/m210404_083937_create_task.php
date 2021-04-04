<?php

use yii\db\Migration;

/**
 * Class m210404_083937_create_task
 */
class m210404_083937_create_task extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(
            'task',
            array(
                'id' => $this->primaryKey(),
                'name' => $this->string()->notNull(),
                'date' => $this->date(),
                'author_id' => $this->integer()->notNull(),
                'executor_id' => $this->integer(),
                'space_room_id' => $this->integer()->notNull(),
                'date_exec' => $this->dateTime()
            )
        );

        $this->createIndex(
            'fk_task_author_idx',
            'task',
            'author_id'
        );

        $this->addForeignKey(
            'fk_task_author_id',
            'task',
            'author_id',
            'user',
            'id'
        );

        $this->createIndex(
            'fk_task_executor_idx',
            'task',
            'executor_id'
        );

        $this->addForeignKey(
            'fk_task_executor_id',
            'task',
            'executor_id',
            'user',
            'id'
        );

        $this->createIndex(
            'fk_task_space_room_idx',
            'task',
            'space_room_id'
        );

        $this->addForeignKey(
            'fk_task_space_room_id',
            'task',
            'space_room_id',
            'space_room',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210404_083937_create_task cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210404_083937_create_task cannot be reverted.\n";

        return false;
    }
    */
}
