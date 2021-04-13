<?php

namespace common\models\space;

use common\models\company\Company;
use common\models\customer\Customer;
use common\models\customer\CustomerHasSpace;
use common\models\customer\TypeCustomer;
use common\models\reference\City;
use common\models\user\User;
use common\models\user\UserHasSpace;
use Yii;

/**
 * This is the model class for table "space".
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $is_del
 * @property int|null $average_score
 * @property int|null $space_type_id
 * @property int|null $city_id
 * @property string|null $telephone
 * @property string|null $address
 * @property string|null $description
 * @property int|null $company_id
 *
 * @property CustomerHasSpace[] $customerHasSpaces
 * @property Customer[] $customers
 * @property Reserve[] $reserves
 * @property City $city
 * @property Company $company
 * @property SpaceType $spaceType
 * @property SpaceHasSubtype[] $spaceHasSubtypes
 * @property SpaceSubtype[] $subtypes
 * @property SpaceRoom[] $spaceRooms
 * @property TypeCustomer[] $typeCustomers
 * @property UserHasSpace[] $userHasSpaces
 * @property User[] $users
 */
class Space extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'space';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['is_del', 'average_score', 'space_type_id', 'city_id', 'company_id'], 'integer'],
            [['name', 'telephone', 'address', 'description'], 'string', 'max' => 255],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::className(), 'targetAttribute' => ['city_id' => 'id']],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::className(), 'targetAttribute' => ['company_id' => 'id']],
            [['space_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => SpaceType::className(), 'targetAttribute' => ['space_type_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Наименование',
            'is_del' => 'Удален?',
            'average_score' => 'Средний чек',
            'space_type_id' => 'Тип заведения',
            'city_id' => 'Город',
            'telephone' => 'Телефон',
            'address' => 'Адрес',
            'description' => 'Описание',
            'company_id' => 'Компания',
        ];
    }

    /**
     * Gets query for [[CustomerHasSpaces]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerHasSpaces()
    {
        return $this->hasMany(CustomerHasSpace::className(), ['space_id' => 'id']);
    }

    /**
     * Gets query for [[Customers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCustomers()
    {
        return $this->hasMany(Customer::className(), ['id' => 'customer_id'])->viaTable('customer_has_space', ['space_id' => 'id']);
    }

    /**
     * Gets query for [[Reserves]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReserves()
    {
        return $this->hasMany(Reserve::className(), ['space_id' => 'id']);
    }

    /**
     * Gets query for [[City]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::className(), ['id' => 'city_id']);
    }

    /**
     * Gets query for [[Company]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Company::className(), ['id' => 'company_id']);
    }

    /**
     * Gets query for [[SpaceType]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSpaceType()
    {
        return $this->hasOne(SpaceType::className(), ['id' => 'space_type_id']);
    }

    /**
     * Gets query for [[SpaceHasSubtypes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSpaceHasSubtypes()
    {
        return $this->hasMany(SpaceHasSubtype::className(), ['space_id' => 'id']);
    }

    /**
     * Gets query for [[Subtypes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubtypes()
    {
        return $this->hasMany(SpaceSubtype::className(), ['id' => 'subtype_id'])->viaTable('space_has_subtype', ['space_id' => 'id']);
    }

    /**
     * Gets query for [[SpaceRooms]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSpaceRooms()
    {
        return $this->hasMany(SpaceRoom::className(), ['space_id' => 'id']);
    }

    /**
     * Gets query for [[TypeCustomers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTypeCustomers()
    {
        return $this->hasMany(TypeCustomer::className(), ['space_id' => 'id']);
    }

    /**
     * Gets query for [[UserHasSpaces]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserHasSpaces()
    {
        return $this->hasMany(UserHasSpace::className(), ['space_id' => 'id']);
    }

    /**
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['id' => 'user_id'])->viaTable('user_has_space', ['space_id' => 'id']);
    }
}
