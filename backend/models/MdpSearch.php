<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Mdp;

/**
 * MdpSearch represents the model behind the search form of `backend\models\Mdp`.
 */
class MdpSearch extends Mdp
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['fiscal_year', 'particulars', 'uacs_code', 'parent_uacs', 'version'], 'safe'],
            [['total_program', 'tra', 'net_program', 'january', 'february', 'march', 'first_total', 'april', 'may', 'june', 'second_total', 'july', 'august', 'september', 'third_total', 'october', 'november', 'december', 'forth_total', 'full_year_total'], 'number'],
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
        $query = Mdp::find();

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
            'total_program' => $this->total_program,
            'tra' => $this->tra,
            'net_program' => $this->net_program,
            'january' => $this->january,
            'february' => $this->february,
            'march' => $this->march,
            'first_total' => $this->first_total,
            'april' => $this->april,
            'may' => $this->may,
            'june' => $this->june,
            'second_total' => $this->second_total,
            'july' => $this->july,
            'august' => $this->august,
            'september' => $this->september,
            'third_total' => $this->third_total,
            'october' => $this->october,
            'november' => $this->november,
            'december' => $this->december,
            'forth_total' => $this->forth_total,
            'full_year_total' => $this->full_year_total,
        ]);

        $query->andFilterWhere(['like', 'fiscal_year', $this->fiscal_year])
            ->andFilterWhere(['like', 'particulars', $this->particulars])
            ->andFilterWhere(['like', 'uacs_code', $this->uacs_code])
            ->andFilterWhere(['like', 'parent_uacs', $this->parent_uacs])
            ->andFilterWhere(['like', 'version', $this->version]);

        $query->groupBy('fiscal_year');

        return $dataProvider;
    }
}
