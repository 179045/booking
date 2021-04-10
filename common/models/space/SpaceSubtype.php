<?php

namespace common\models\space;

use Yii;

/**
 * This is the model class for table "space_subtype".
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $parent_id
 * @property int|null $is_del
 *
 * @property SpaceHasSubtype[] $spaceHasSubtypes
 * @property SpaceHasSubtype[] $spaceHasSubtypes0
 * @property Space[] $spaces
 * @property SpaceSubtype $parent
 * @property SpaceSubtype[] $spaceSubtypes
 */
class SpaceSubtype extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'space_subtype';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent_id', 'is_del'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => SpaceSubtype::className(), 'targetAttribute' => ['parent_id' => 'id']],
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
     * Gets query for [[SpaceHasSubtypes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSpaceHasSubtypes()
    {
        return $this->hasMany(SpaceHasSubtype::className(), ['parent_subtype_id' => 'id']);
    }

    /**
     * Gets query for [[SpaceHasSubtypes0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSpaceHasSubtypes0()
    {
        return $this->hasMany(SpaceHasSubtype::className(), ['subtype_id' => 'id']);
    }

    /**
     * Gets query for [[Spaces]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSpaces()
    {
        return $this->hasMany(Space::className(), ['id' => 'space_id'])->viaTable('space_has_subtype', ['subtype_id' => 'id']);
    }

    /**
     * Gets query for [[Parent]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(SpaceSubtype::className(), ['id' => 'parent_id']);
    }

    /**
     * Gets query for [[SpaceSubtypes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSpaceSubtypes()
    {
        return $this->hasMany(SpaceSubtype::className(), ['parent_id' => 'id']);
    }
}
