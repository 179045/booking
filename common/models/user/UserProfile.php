<?php

namespace common\models\user;

use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;
use Yii;

/**
 * This is the model class for table "user_profile".
 *
 * @property int $id
 * @property string $fio
 * @property string|null $position
 * @property int|null $user_id
 *
 * @property User $user
 */
class UserProfile extends \yii\db\ActiveRecord
{

    public function behaviors()
    {
        return [
            'saveRelations' => [
                'class'     => SaveRelationsBehavior::className(),
                'relations' => [
                    'user',
                ],
            ],
        ];
    }


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_profile';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fio'], 'required'],
            [['user_id'], 'integer'],
            [['fio', 'position'], 'string', 'max' => 255],
            [['user'], 'safe'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fio' => 'ФИО',
            'position' => 'Должность',
            'user_id' => '',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
