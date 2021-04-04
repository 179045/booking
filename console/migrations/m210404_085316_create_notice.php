<?php

use yii\db\Migration;

/**
 * Class m210404_085316_create_notice
 */
class m210404_085316_create_notice extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(
            'notice',
            array(
                'id' => $this->primaryKey(),
                'is_task' => $this->boolean(),
                'reserve_id' => $this->integer(),
                'task_id' => $this->integer(),
                'date' => $this->date(),
                'space_room_id' => $this->integer()->notNull()
            )
        );

        $this->createIndex(
            'fk_notice_reserve_idx',
            'notice',
            'reserve_id'
        );

        $this->addForeignKey(
            'fk_notice_reserve_id',
            'notice',
            'reserve_id',
            'reserve',
            'id'
        );

        $this->createIndex(
            'fk_notice_task_idx',
            'notice',
            'task_id'
        );

        $this->addForeignKey(
            'fk_notice_task_id',
            'notice',
            'task_id',
            'task',
            'id'
        );

        $this->createIndex(
            'fk_notice_space_room_idx',
            'notice',
            'space_room_id'
        );

        $this->addForeignKey(
            'fk_notice_space_room_id',
            'notice',
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
        echo "m210404_085316_create_notice cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210404_085316_create_notice cannot be reverted.\n";

        return false;
    }
    */
}
