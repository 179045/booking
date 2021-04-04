<?php

use yii\db\Migration;

/**
 * Class m210404_080717_create_type_customer
 */
class m210404_080717_create_type_customer extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('type_customer',
            array(
                'id' => $this->primaryKey(),
                'name' => $this->string(),
                'is_del' => $this->boolean(),
                'space_id' => $this->integer()
            )
        );

        $this->createIndex(
            'fk_type_customer_space_idx',
            'type_customer',
            'space_id'
        );

        $this->addForeignKey(
            'fk_type_customer_space_id',
            'type_customer',
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
        echo "m210404_080717_create_type_customer cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210404_080717_create_type_customer cannot be reverted.\n";

        return false;
    }
    */
}
