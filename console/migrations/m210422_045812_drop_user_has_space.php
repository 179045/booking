<?php

use yii\db\Migration;

/**
 * Class m210422_045812_drop_user_has_space
 */
class m210422_045812_drop_user_has_space extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropTable('user_has_space');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210422_045812_drop_user_has_space cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210422_045812_drop_user_has_space cannot be reverted.\n";

        return false;
    }
    */
}
