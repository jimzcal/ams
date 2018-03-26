<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\LddapAda;

/**
 * LddapAdaSearch represents the model behind the search form of `backend\models\LddapAda`.
 */
class LddapAdaSearch extends LddapAda
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['date', 'lddap_no', 'dv_no', 'current_account', 'uacs_code', 'remarks'], 'safe'],
            [['net_amount'], 'number'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = LddapAda::find();

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
            'net_amount' => $this->net_amount,
        ]);

        $query->andFilterWhere(['like', 'date', $this->date])
            ->andFilterWhere(['like', 'lddap_no', $this->lddap_no])
            ->andFilterWhere(['like', 'dv_no', $this->dv_no])
            ->andFilterWhere(['like', 'current_account', $this->current_account])
            ->andFilterWhere(['like', 'uacs_code', $this->uacs_code])
            ->andFilterWhere(['like', 'remarks', $this->remarks]);

        return $dataProvider;
    }
}
