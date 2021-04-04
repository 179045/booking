<?php

use yii\db\Migration;

/**
 * Class m210404_080344_create_user_has_company
 */
class m210404_080344_create_user_has_company extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user_has_company', [
            'user_id' => $this->integer()->notNull(),
            'company_id' => $this->integer()->notNull(),
        ]);

        $this->addPrimaryKey(
            'user_has_company_pk',
            'user_has_company',
            ['company_id', 'user_id']
        );

        $this->createIndex(
            'fk_user_has_company_company_idx',
            'user_has_company',
            'company_id'
        );

        $this->addForeignKey(
            'fk_user_has_company_company_id',
            'user_has_company',
            'company_id',
            'company',
            'id'
        );

        $this->createIndex(
            'fk_user_has_company_user_idx',
            'user_has_company',
            'user_id'
        );

        $this->addForeignKey(
            'fk_user_has_company_user_id',
            'user_has_company',
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
        echo "m210404_080344_create_user_has_company cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210404_080344_create_user_has_company cannot be reverted.\n";

        return false;
    }
    */
}
