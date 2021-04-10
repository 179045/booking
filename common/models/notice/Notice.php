<?php

namespace common\models\notice;

use Yii;

/**
 * This is the model class for table "notice".
 *
 * @property int $id
 * @property int|null $is_task
 * @property int|null $reserve_id
 * @property int|null $task_id
 * @property string|null $date
 * @property int $space_room_id
 *
 * @property Reserve $reserve
 * @property SpaceRoom $spaceRoom
 * @property Task $task
 */
class Notice extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'notice';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['is_task', 'reserve_id', 'task_id', 'space_room_id'], 'integer'],
            [['date'], 'safe'],
            [['space_room_id'], 'required'],
            [['reserve_id'], 'exist', 'skipOnError' => true, 'targetClass' => Reserve::className(), 'targetAttribute' => ['reserve_id' => 'id']],
            [['space_room_id'], 'exist', 'skipOnError' => true, 'targetClass' => SpaceRoom::className(), 'targetAttribute' => ['space_room_id' => 'id']],
            [['task_id'], 'exist', 'skipOnError' => true, 'targetClass' => Task::className(), 'targetAttribute' => ['task_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'is_task' => 'Is Task',
            'reserve_id' => 'Reserve ID',
            'task_id' => 'Task ID',
            'date' => 'Date',
            'space_room_id' => 'Space Room ID',
        ];
    }

    /**
     * Gets query for [[Reserve]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReserve()
    {
        return $this->hasOne(Reserve::className(), ['id' => 'reserve_id']);
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
     * Gets query for [[Task]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTask()
    {
        return $this->hasOne(Task::className(), ['id' => 'task_id']);
    }
}
