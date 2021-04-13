<?php

namespace common\models\user;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\user\UserHasCompany;

/**
 * UserHasCompanySearch represents the model behind the search form of `common\models\user\UserHasCompany`.
 */
class UserHasCompanySearch extends UserHasCompany
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'company_id'], 'integer'],
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
    public function search($company_id, $params)
    {
        $query = UserHasCompany::find();

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
            'user_id' => $this->user_id,
//            'company_id' => $this->company_id,
            'company_id' => $company_id,
        ]);

        return $dataProvider;
    }
}
