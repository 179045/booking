<?php

use yii\db\Migration;

/**
 * Class m210422_045853_add_column_company_id_space_id
 */
class m210422_045853_add_column_company_id_space_id extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(
            'user',
            'company_id',
            $this->integer()
        );

        $this->createIndex(
            'fk_user_company_id_idx',
            'user',
            'company_id'
        );

        $this->addForeignKey(
            'fk_user_company_id_id1',
            'user',
            'company_id',
            'company',
            'id'
        );

        $this->addColumn(
            'user',
            'space_id',
            $this->integer()
        );

        $this->createIndex(
            'fk_user_space_id_idx',
            'user',
            'space_id'
        );

        $this->addForeignKey(
            'fk_user_space_id_id1',
            'user',
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

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210422_045853_add_column_company_id_space_id cannot be reverted.\n";

        return false;
    }
    */
}
