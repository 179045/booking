<?php

use yii\db\Migration;

/**
 * Class m210422_032500_insert_user_roles
 */
class m210422_032500_insert_user_roles extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;
        $admin = $auth->createRole('admin');
        $admin->description = 'Супер-админ';
        $auth->add($admin);

        $director = $auth->createRole('director');
        $director->description = 'Директор заведения';
        $auth->add($director);

        $manager = $auth->createRole('manager');
        $manager->description = 'Менеджер (администратор заведения)';
        $auth->add($manager);

        $auth->addChild($admin, $director);
        $auth->addChild($admin, $manager);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $auth = Yii::$app->authManager;
        $auth->remove($auth->getRole('director'));
        $auth->remove($auth->getRole('manager'));
        $auth->remove($auth->getRole('admin'));
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210422_032500_insert_user_roles cannot be reverted.\n";

        return false;
    }
    */
}
