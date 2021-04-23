<?php

use yii\db\Migration;

/**
 * Class m210422_045822_drop_user_has_company
 */
class m210422_045822_drop_user_has_company extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropTable('user_has_company');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210422_045822_drop_user_has_company cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210422_045822_drop_user_has_company cannot be reverted.\n";

        return false;
    }
    */
}
