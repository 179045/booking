<?php

namespace common\models\inventory;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\inventory\Inventory;

/**
 * InventorySearch represents the model behind the search form of `common\models\inventory\Inventory`.
 */
class InventorySearch extends Inventory
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'quantity', 'space_id'], 'integer'],
            [['name', 'serial', 'number', 'date_created', 'date_updated'], 'safe'],
            [['sum'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Inventory::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'quantity' => $this->quantity,
            'sum' => $this->sum,
            'space_id' => $this->space_id,
            'date_created' => $this->date_created,
            'date_updated' => $this->date_updated,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'serial', $this->serial])
            ->andFilterWhere(['like', 'number', $this->number]);

        return $dataProvider;
    }
}
