<?php

namespace common\models\customer;

use Yii;

/**
 * This is the model class for table "type_customer".
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $is_del
 * @property int|null $space_id
 *
 * @property CustomerHasSpace[] $customerHasSpaces
 * @property Space $space
 */
class TypeCustomer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'type_customer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['is_del', 'space_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['space_id'], 'exist', 'skipOnError' => true, 'targetClass' => Space::className(), 'targetAttribute' => ['space_id' => 'id']],
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
            'is_del' => 'Is Del',
            'space_id' => 'Space ID',
        ];
    }

    /**
     * Gets query for [[CustomerHasSpaces]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerHasSpaces()
    {
        return $this->hasMany(CustomerHasSpace::className(), ['type_customer_id' => 'id']);
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
}
