<?php

namespace common\models\space;

use Yii;

/**
 * This is the model class for table "place".
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $quantity
 * @property int|null $number
 * @property int|null $is_del
 * @property int|null $space_room_id
 *
 * @property SpaceRoom $spaceRoom
 * @property Reserve[] $reserves
 */
class Place extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'place';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['quantity', 'number', 'is_del', 'space_room_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['space_room_id'], 'exist', 'skipOnError' => true, 'targetClass' => SpaceRoom::className(), 'targetAttribute' => ['space_room_id' => 'id']],
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
            'quantity' => 'Quantity',
            'number' => 'Number',
            'is_del' => 'Is Del',
            'space_room_id' => 'Space Room ID',
        ];
    }

    /**
     * Gets query for [[SpaceRoom]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSpaceRoom()
    {
        return $this->hasOne(SpaceRoom::className(), ['id' => 'space_room_id']);
    }

    /**
     * Gets query for [[Reserves]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReserves()
    {
        return $this->hasMany(Reserve::className(), ['place_id' => 'id']);
    }
}
