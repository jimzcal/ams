<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Nca;

/**
 * NcaSearch represents the model behind the search form of `backend\models\Nca`.
 */
class NcaSearch extends Nca
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['date', 'nca_no', 'fund_cluster', 'mds_sub_acc_no', 'gsb_branch', 'purpose', 'period'], 'safe'],
            [['amount'], 'number'],
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
        $query = Nca::find();

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
            'amount' => $this->amount,
        ]);

        $query->andFilterWhere(['like', 'date', $this->date])
            ->andFilterWhere(['like', 'nca_no', $this->nca_no])
            ->andFilterWhere(['like', 'fund_cluster', $this->fund_cluster])
            ->andFilterWhere(['like', 'mds_sub_acc_no', $this->mds_sub_acc_no])
            ->andFilterWhere(['like', 'gsb_branch', $this->gsb_branch])
            ->andFilterWhere(['like', 'purpose', $this->purpose])
            ->andFilterWhere(['like', 'period', $this->period]);

        return $dataProvider;
    }
}
