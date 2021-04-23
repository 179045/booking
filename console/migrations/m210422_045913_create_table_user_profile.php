<?php

use yii\db\Migration;

/**
 * Class m210422_045913_create_table_user_profile
 */
class m210422_045913_create_table_user_profile extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(
            'user_profile',
            [
                'id' => $this->primaryKey(),
                'fio' => $this->string()->notNull(),
                'position' => $this->string(),
                'user_id' => $this->integer()
            ]
        );

        $this->createIndex(
            'fk_user_profile_user_id_idx',
            'user_profile',
            'user_id'
        );

        $this->addForeignKey(
            'fk_user_profile_user_id_id1',
            'user_profile',
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
        $this->dropTable('user_profile');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210422_045913_create_table_user_profile cannot be reverted.\n";

        return false;
    }
    */
}
