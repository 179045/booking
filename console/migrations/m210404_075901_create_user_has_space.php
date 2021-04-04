<?php

use yii\db\Migration;

/**
 * Class m210404_075901_create_user_has_space
 */
class m210404_075901_create_user_has_space extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user_has_space', [
            'user_id' => $this->integer()->notNull(),
            'space_id' => $this->integer()->notNull(),
        ]);

        $this->addPrimaryKey(
            'user_has_space_pk',
            'user_has_space',
            ['space_id', 'user_id']
        );

        $this->createIndex(
            'fk_user_has_space_space_idx',
            'user_has_space',
            'space_id'
        );

        $this->addForeignKey(
            'fk_user_has_space_space_id',
            'user_has_space',
            'space_id',
            'space',
            'id'
        );

        $this->createIndex(
            'fk_user_has_space_user_idx',
            'user_has_space',
            'user_id'
        );

        $this->addForeignKey(
            'fk_user_has_space_user_id',
            'user_has_space',
            'user_id',
            'user',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210404_075901_create_user_has_space cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210404_075901_create_user_has_space cannot be reverted.\n";

        return false;
    }
    */
}
