<?php

namespace common\models\task;

use Yii;

/**
 * This is the model class for table "task".
 *
 * @property int $id
 * @property string $name
 * @property string|null $date
 * @property int $author_id
 * @property int|null $executor_id
 * @property int $space_room_id
 * @property string|null $date_exec
 *
 * @property Notice[] $notices
 * @property User $author
 * @property User $executor
 * @property SpaceRoom $spaceRoom
 */
class Task extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'task';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'author_id', 'space_room_id'], 'required'],
            [['date', 'date_exec'], 'safe'],
            [['author_id', 'executor_id', 'space_room_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['author_id' => 'id']],
            [['executor_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['executor_id' => 'id']],
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
            'date' => 'Date',
            'author_id' => 'Author ID',
            'executor_id' => 'Executor ID',
            'space_room_id' => 'Space Room ID',
            'date_exec' => 'Date Exec',
        ];
    }

    /**
     * Gets query for [[Notices]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNotices()
    {
        return $this->hasMany(Notice::className(), ['task_id' => 'id']);
    }

    /**
     * Gets query for [[Author]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'author_id']);
    }

    /**
     * Gets query for [[Executor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExecutor()
    {
        return $this->hasOne(User::className(), ['id' => 'executor_id']);
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
}
