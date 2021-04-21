<?php

namespace common\models\inventory;

use common\models\company\Company;
use common\models\space\Space;
use Yii;

/**
 * This is the model class for table "inventory".
 *
 * @property int $id
 * @property string $name
 * @property string|null $serial
 * @property string|null $number
 * @property int|null $quantity
 * @property float|null $sum
 * @property int $space_id
 * @property string|null $date_created
 * @property string|null $date_updated
 *
 * @property Space $space
 */
class Inventory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'inventory';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'space_id'], 'required'],
            [['quantity', 'space_id'], 'integer'],
            [['sum'], 'number'],
            [['date_created', 'date_updated'], 'safe'],
            [['name', 'serial', 'number'], 'string', 'max' => 255],
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
            'name' => 'Наименование',
            'serial' => 'Серия',
            'number' => 'Номер',
            'quantity' => 'Количество',
            'sum' => 'Стоимость',
            'space_id' => 'Заведение',
            'date_created' => 'Дата создания',
            'date_updated' => 'Дата обновления',
        ];
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
