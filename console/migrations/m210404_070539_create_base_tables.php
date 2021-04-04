<?php

use yii\db\Migration;

/**
 * Class m210404_070539_create_base_tables
 */
class m210404_070539_create_base_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('city', array(
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'is_del' => $this->boolean()
        ));

        $this->createTable('company', array(
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'description' => $this->string(),
            'is_del' => $this->boolean()
        ));

        $this->createTable('customer', array(
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'telephone' => $this->integer(),
            'is_del' => $this->boolean()
        ));
        /* SPACE START */
        $this->createTable('space_type', array(
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'parent_id' => $this->integer(),
            'is_del' => $this->boolean()
        ));

        $this->createIndex(
            'fk_space_type_parent_idx',
            'space_type',
            'parent_id'
        );

        $this->addForeignKey(
            'fk_space_type_parent_id',
            'space_type',
            'parent_id',
            'space_type',
            'id'
        );

        $this->createTable('space_subtype', array(
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'parent_id' => $this->integer(),
            'is_del' => $this->boolean()
        ));

        $this->createIndex(
            'fk_space_subtype_parent_idx',
            'space_subtype',
            'parent_id'
        );

        $this->addForeignKey(
            'fk_space_subtype_parent_id',
            'space_subtype',
            'parent_id',
            'space_subtype',
            'id'
        );

        $this->createTable('space', array(
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'is_del' => $this->boolean(),
            'average_score' => $this->integer(),
            'space_type_id' => $this->integer(),
            'city_id' => $this->integer(),
            'telephone' => $this->string(),
            'address' => $this->string(),
            'description' => $this->string(),
            'company_id' => $this->integer()
        ));

        $this->createIndex(
            'fk_space_space_type_idx',
            'space',
            'space_type_id'
        );

        $this->addForeignKey(
            'fk_space_space_type_id',
            'space',
            'space_type_id',
            'space_type',
            'id'
        );

        $this->createIndex(
            'fk_space_city_idx',
            'space',
            'city_id'
        );

        $this->addForeignKey(
            'fk_space_city_id',
            'space',
            'city_id',
            'city',
            'id'
        );

        $this->createIndex(
            'fk_space_company_idx',
            'space',
            'company_id'
        );

        $this->addForeignKey(
            'fk_space_company_id',
            'space',
            'company_id',
            'company',
            'id'
        );

        $this->createTable('space_room', array(
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'is_del' => $this->boolean(),
            'space_id' => $this->integer()
        ));

        $this->createIndex(
            'fk_space_room_space_idx',
            'space_room',
            'space_id'
        );

        $this->addForeignKey(
            'fk_space_room_space_id',
            'space_room',
            'space_id',
            'space',
            'id'
        );

        $this->createTable('place', array(
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'quantity' => $this->integer(),
            'number' => $this->integer(),
            'is_del' => $this->boolean(),
            'space_room_id' => $this->integer()
        ));

        $this->createIndex(
            'fk_place_space_room_idx',
            'place',
            'space_room_id'
        );

        $this->addForeignKey(
            'fk_place_space_room_id',
            'place',
            'space_room_id',
            'space_room',
            'id'
        );

        $this->createTable('space_has_subtype', [
            'space_id' => $this->integer()->notNull(),
            'subtype_id' => $this->integer()->notNull(),
            'name_subtype' => $this->string(),
            'parent_subtype_id' => $this->integer(),
            'name_parent_subtype' => $this->string()
        ]);

        $this->addPrimaryKey(
            'space_has_subtype_pk',
            'space_has_subtype',
            ['space_id', 'subtype_id']
        );

        $this->createIndex(
            'fk_space_has_subtype_space_idx',
            'space_has_subtype',
            'space_id'
        );

        $this->addForeignKey(
            'fk_space_has_subtype_space_id',
            'space_has_subtype',
            'space_id',
            'space',
            'id'
        );

        $this->createIndex(
            'fk_space_has_subtype_subtype_idx',
            'space_has_subtype',
            'subtype_id'
        );

        $this->addForeignKey(
            'fk_space_has_subtype_subtype_id',
            'space_has_subtype',
            'subtype_id',
            'space_subtype',
            'id'
        );

        $this->createIndex(
            'fk_space_has_subtype_parent_subtype_idx',
            'space_has_subtype',
            'parent_subtype_id'
        );

        $this->addForeignKey(
            'fk_space_has_subtype_parent_subtype_id',
            'space_has_subtype',
            'parent_subtype_id',
            'space_subtype',
            'id'
        );


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210404_070539_create_base_tables cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210404_070539_create_base_tables cannot be reverted.\n";

        return false;
    }
    */
}
