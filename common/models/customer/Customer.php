<?php

namespace common\models\customer;

use Yii;

/**
 * This is the model class for table "customer".
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $telephone
 * @property int|null $is_del
 *
 * @property CustomerHasSpace[] $customerHasSpaces
 * @property Space[] $spaces
 * @property Reserve[] $reserves
 */
class Customer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'customer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['telephone', 'is_del'], 'integer'],
            [['name'], 'string', 'max' => 255],
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
            'telephone' => 'Telephone',
            'is_del' => 'Is Del',
        ];
    }

    /**
     * Gets query for [[CustomerHasSpaces]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerHasSpaces()
    {
        return $this->hasMany(CustomerHasSpace::className(), ['customer_id' => 'id']);
    }

    /**
     * Gets query for [[Spaces]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSpaces()
    {
        return $this->hasMany(Space::className(), ['id' => 'space_id'])->viaTable('customer_has_space', ['customer_id' => 'id']);
    }

    /**
     * Gets query for [[Reserves]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReserves()
    {
        return $this->hasMany(Reserve::className(), ['customer_id' => 'id']);
    }
}
