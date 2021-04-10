<?php

namespace common\models\space;

use Yii;

/**
 * This is the model class for table "space_has_subtype".
 *
 * @property int $space_id
 * @property int $subtype_id
 * @property string|null $name_subtype
 * @property int|null $parent_subtype_id
 * @property string|null $name_parent_subtype
 *
 * @property SpaceSubtype $parentSubtype
 * @property Space $space
 * @property SpaceSubtype $subtype
 */
class SpaceHasSubtype extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'space_has_subtype';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['space_id', 'subtype_id'], 'required'],
            [['space_id', 'subtype_id', 'parent_subtype_id'], 'integer'],
            [['name_subtype', 'name_parent_subtype'], 'string', 'max' => 255],
            [['space_id', 'subtype_id'], 'unique', 'targetAttribute' => ['space_id', 'subtype_id']],
            [['parent_subtype_id'], 'exist', 'skipOnError' => true, 'targetClass' => SpaceSubtype::className(), 'targetAttribute' => ['parent_subtype_id' => 'id']],
            [['space_id'], 'exist', 'skipOnError' => true, 'targetClass' => Space::className(), 'targetAttribute' => ['space_id' => 'id']],
            [['subtype_id'], 'exist', 'skipOnError' => true, 'targetClass' => SpaceSubtype::className(), 'targetAttribute' => ['subtype_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'space_id' => 'Space ID',
            'subtype_id' => 'Subtype ID',
            'name_subtype' => 'Name Subtype',
            'parent_subtype_id' => 'Parent Subtype ID',
            'name_parent_subtype' => 'Name Parent Subtype',
        ];
    }

    /**
     * Gets query for [[ParentSubtype]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getParentSubtype()
    {
        return $this->hasOne(SpaceSubtype::className(), ['id' => 'parent_subtype_id']);
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
     * Gets query for [[Subtype]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubtype()
    {
        return $this->hasOne(SpaceSubtype::className(), ['id' => 'subtype_id']);
    }
}
