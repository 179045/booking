<?php

namespace common\models\space;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\space\Space;

/**
 * SpaceSearch represents the model behind the search form of `common\models\space\Space`.
 */
class SpaceSearch extends Space
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'is_del', 'average_score', 'space_type_id', 'city_id', 'company_id'], 'integer'],
            [['name', 'telephone', 'address', 'description'], 'safe'],
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
     * @param integer $company_id
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($company_id, $params)
    {
        $query = Space::find();

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
            'is_del' => $this->is_del,
            'average_score' => $this->average_score,
            'space_type_id' => $this->space_type_id,
            'city_id' => $this->city_id,
//            'company_id' => $this->company_id,
            'company_id' => $company_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'telephone', $this->telephone])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
