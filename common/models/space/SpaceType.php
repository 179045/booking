<?php

namespace common\models\space;

use Yii;

/**
 * This is the model class for table "space_type".
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $parent_id
 * @property int|null $is_del
 *
 * @property Space[] $spaces
 * @property SpaceType $parent
 * @property SpaceType[] $spaceTypes
 */
class SpaceType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'space_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent_id', 'is_del'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => SpaceType::className(), 'targetAttribute' => ['parent_id' => 'id']],
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
            'parent_id' => 'Parent ID',
            'is_del' => 'Is Del',
        ];
    }

    /**
     * Gets query for [[Spaces]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSpaces()
    {
        return $this->hasMany(Space::className(), ['space_type_id' => 'id']);
    }

    /**
     * Gets query for [[Parent]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(SpaceType::className(), ['id' => 'parent_id']);
    }

    /**
     * Gets query for [[SpaceTypes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSpaceTypes()
    {
        return $this->hasMany(SpaceType::className(), ['parent_id' => 'id']);
    }
}
