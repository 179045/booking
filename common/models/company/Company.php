<?php

namespace common\models\company;

use Yii;

/**
 * This is the model class for table "company".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property int|null $is_del
 *
 * @property Space[] $spaces
 * @property UserHasCompany[] $userHasCompanies
 * @property User[] $users
 */
class Company extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'company';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['is_del'], 'integer'],
            [['name', 'description'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'is_del' => 'Is Del',
        ];
    }

    /**
     * Gets query for [[Spaces]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSpaces()
    {
        return $this->hasMany(Space::className(), ['company_id' => 'id']);
    }

    /**
     * Gets query for [[UserHasCompanies]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserHasCompanies()
    {
        return $this->hasMany(UserHasCompany::className(), ['company_id' => 'id']);
    }

    /**
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['id' => 'user_id'])->viaTable('user_has_company', ['company_id' => 'id']);
    }
}
