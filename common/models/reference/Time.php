<?php

namespace common\models\reference;

use Yii;

/**
 * This is the model class for table "time".
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $is_del
 *
 * @property Reserve[] $reserves
 */
class Time extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'time';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['is_del'], 'integer'],
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
            'is_del' => 'Is Del',
        ];
    }

    /**
     * Gets query for [[Reserves]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReserves()
    {
        return $this->hasMany(Reserve::className(), ['time_id' => 'id']);
    }
}
