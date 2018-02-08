<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\AccountingEntry;

/**
 * AccountingEntrySearch represents the model behind the search form of `backend\models\AccountingEntry`.
 */
class AccountingEntrySearch extends AccountingEntry
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['dv_no', 'account_title', 'uacs_code', 'credit_to'], 'safe'],
            [['debit', 'credit_amount'], 'number'],
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
        $query = AccountingEntry::find();

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
            'debit' => $this->debit,
            'credit_amount' => $this->credit_amount,
        ]);

        $query->andFilterWhere(['like', 'dv_no', $this->dv_no])
            ->andFilterWhere(['like', 'account_title', $this->account_title])
            ->andFilterWhere(['like', 'uacs_code', $this->uacs_code])
            ->andFilterWhere(['like', 'credit_to', $this->credit_to]);

        return $dataProvider;
    }
}
