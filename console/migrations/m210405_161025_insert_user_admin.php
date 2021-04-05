<?php

use common\models\User;
use yii\db\Migration;

/**
 * Class m210405_161025_insert_user_admin
 */
class m210405_161025_insert_user_admin extends Migration
{
    /**
     * {@inheritdoc}
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\db\Exception
     */
    public function safeUp()
    {

        $transaction = $this->getDb()->beginTransaction();
        $user = \Yii::createObject([
            'class'    => User::className(),
            'scenario' => 'create',
            'username'    => 'admin',
            'email' => 'admin@example.com',
            'password' => 123456,
        ]);
        if (!$user->insert(false)) {
            $transaction->rollBack();
            return false;
        }
        //$user->confirm();
        $transaction->commit();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210405_161025_insert_user_admin cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210405_161025_insert_user_admin cannot be reverted.\n";

        return false;
    }
    */
}
