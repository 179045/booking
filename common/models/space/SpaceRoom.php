<?php

namespace common\models\space;

use Yii;

/**
 * This is the model class for table "space_room".
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $is_del
 * @property int|null $space_id
 *
 * @property Notice[] $notices
 * @property Place[] $places
 * @property Space $space
 * @property Task[] $tasks
 */
class SpaceRoom extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'space_room';
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
     * Gets query for [[Notices]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNotices()
    {
        return $this->hasMany(Notice::className(), ['space_room_id' => 'id']);
    }

    /**
     * Gets query for [[Places]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPlaces()
    {
        return $this->hasMany(Place::className(), ['space_room_id' => 'id']);
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
     * Gets query for [[Tasks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Task::className(), ['space_room_id' => 'id']);
    }
}
