<?php

namespace common\models\customer;

use common\models\space\Space;
use Yii;

/**
 * This is the model class for table "customer_has_space".
 *
 * @property int $customer_id
 * @property int $space_id
 * @property int|null $rating
 * @property int|null $type_customer_id
 *
 * @property Customer $customer
 * @property Space $space
 * @property TypeCustomer $typeCustomer
 */
class CustomerHasSpace extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'customer_has_space';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['customer_id', 'space_id'], 'required'],
            [['customer_id', 'space_id', 'rating', 'type_customer_id'], 'integer'],
            [['customer_id', 'space_id'], 'unique', 'targetAttribute' => ['customer_id', 'space_id']],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customer_id' => 'id']],
            [['space_id'], 'exist', 'skipOnError' => true, 'targetClass' => Space::className(), 'targetAttribute' => ['space_id' => 'id']],
            [['type_customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => TypeCustomer::className(), 'targetAttribute' => ['type_customer_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'customer_id' => 'Customer ID',
            'space_id' => 'Space ID',
            'rating' => 'Rating',
            'type_customer_id' => 'Type Customer ID',
        ];
    }

    /**
     * Gets query for [[Customer]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id']);
    }

    /**
     * Gets query for [[Space]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSpace()
    {
        return $this->hasOne(Space::className(), ['id' => 'space_id']);
    }

    /**
     * Gets query for [[TypeCustomer]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTypeCustomer()
    {
        return $this->hasOne(TypeCustomer::className(), ['id' => 'type_customer_id']);
    }
}
