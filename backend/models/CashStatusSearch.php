<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\CashStatus;

/**
 * CashStatusSearch represents the model behind the search form of `backend\models\CashStatus`.
 */
class CashStatusSearch extends CashStatus
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['nca_no', 'dv_no'], 'safe'],
            [['current_balance', 'disbursement_amount', 'balance'], 'number'],
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
        $query = CashStatus::find()->where(['nca_no' => $params]);

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
            'current_balance' => $this->current_balance,
            'dv_no' => $this->dv_no,
            'disbursement_amount' => $this->disbursement_amount,
        ]);

        $query->andFilterWhere(['like', 'nca_no', $this->nca_no]);

        return $dataProvider;
    }
}
