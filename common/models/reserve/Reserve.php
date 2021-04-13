<?php

namespace common\models\reserve;

use Yii;

/**
 * This is the model class for table "reserve".
 *
 * @property int $id
 * @property string $date
 * @property int $time_id
 * @property int $customer_id
 * @property int $space_id
 * @property int|null $place_id
 * @property int|null $count_person
 * @property int|null $count_person_fact
 * @property int|null $prepay
 * @property string|null $note
 * @property int|null $is_fact
 * @property int|null $is_waiting
 * @property int $status_id
 *
 * @property Notice[] $notices
 * @property Customer $customer
 * @property Place $place
 * @property Space $space
 * @property StatusReserve $status
 * @property Time $time
 */
class Reserve extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reserve';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date', 'time_id', 'customer_id', 'space_id', 'status_id'], 'required'],
            [['date'], 'safe'],
            [['time_id', 'customer_id', 'space_id', 'place_id', 'count_person', 'count_person_fact', 'prepay', 'is_fact', 'is_waiting', 'status_id'], 'integer'],
            [['note'], 'string', 'max' => 255],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customer_id' => 'id']],
            [['place_id'], 'exist', 'skipOnError' => true, 'targetClass' => Place::className(), 'targetAttribute' => ['place_id' => 'id']],
            [['space_id'], 'exist', 'skipOnError' => true, 'targetClass' => Space::className(), 'targetAttribute' => ['space_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => StatusReserve::className(), 'targetAttribute' => ['status_id' => 'id']],
            [['time_id'], 'exist', 'skipOnError' => true, 'targetClass' => Time::className(), 'targetAttribute' => ['time_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Date',
            'time_id' => 'Time ID',
            'customer_id' => 'Customer ID',
            'space_id' => 'Space ID',
            'place_id' => 'Place ID',
            'count_person' => 'Count Person',
            'count_person_fact' => 'Count Person Fact',
            'prepay' => 'Prepay',
            'note' => 'Note',
            'is_fact' => 'Is Fact',
            'is_waiting' => 'Is Waiting',
            'status_id' => 'Status ID',
        ];
    }

    /**
     * Gets query for [[Notices]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNotices()
    {
        return $this->hasMany(Notice::className(), ['reserve_id' => 'id']);
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
     * Gets query for [[Place]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPlace()
    {
        return $this->hasOne(Place::className(), ['id' => 'place_id']);
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
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(StatusReserve::className(), ['id' => 'status_id']);
    }

    /**
     * Gets query for [[Time]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTime()
    {
        return $this->hasOne(Time::className(), ['id' => 'time_id']);
    }
}
