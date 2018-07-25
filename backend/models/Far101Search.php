<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Far101;

/**
 * Far101Search represents the model behind the search form of `backend\models\Far101`.
 */
class Far101Search extends Far101
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['fiscal_year', 'fund_cluster', 'particulars', 'uacs_code', 'parent_uacs'], 'safe'],
            [['obligation_q_1', 'obligation_q_2', 'obligation_q_3', 'obligation_q_4', 'total_obligation', 'disbursement_q_1', 'disbursement_q_2', 'disbursement_q_3', 'disbursement_q_4', 'total_disbursement'], 'number'],
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
        $query = Far101::find();

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
            'obligation_q_1' => $this->obligation_q_1,
            'obligation_q_2' => $this->obligation_q_2,
            'obligation_q_3' => $this->obligation_q_3,
            'obligation_q_4' => $this->obligation_q_4,
            'total_obligation' => $this->total_obligation,
            'disbursement_q_1' => $this->disbursement_q_1,
            'disbursement_q_2' => $this->disbursement_q_2,
            'disbursement_q_3' => $this->disbursement_q_3,
            'disbursement_q_4' => $this->disbursement_q_4,
            'total_disbursement' => $this->total_disbursement,
        ]);

        $query->andFilterWhere(['like', 'fiscal_year', $this->fiscal_year])
            ->andFilterWhere(['like', 'fund_cluster', $this->fund_cluster])
            ->andFilterWhere(['like', 'particulars', $this->particulars])
            ->andFilterWhere(['like', 'uacs_code', $this->uacs_code])
            ->andFilterWhere(['like', 'parent_uacs', $this->parent_uacs]);

        $query->groupBy(['fiscal_year', 'fund_cluster']);

        return $dataProvider;
    }
}
