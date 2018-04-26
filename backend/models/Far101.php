<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "far_1_01".
 *
 * @property int $id
 * @property string $fiscal_year
 * @property string $fund_cluster
 * @property int $parent_id
 * @property string $particulars
 * @property string $uacs_code
 * @property string $obligation_q_1
 * @property string $obligation_q_2
 * @property string $obligation_q_3
 * @property string $obligation_q_4
 * @property string $total_obligation
 * @property string $disbursement_q_1
 * @property string $disbursement_q_2
 * @property string $disbursement_q_3
 * @property string $disbursement_q_4
 * @property string $total_disbursement
 */
class Far101 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'far_1_01';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fiscal_year', 'fund_cluster', 'parent_id', 'particulars', 'uacs_code', 'obligation_q_1', 'obligation_q_2', 'obligation_q_3', 'obligation_q_4', 'total_obligation', 'disbursement_q_1', 'disbursement_q_2', 'disbursement_q_3', 'disbursement_q_4', 'total_disbursement'], 'required'],
            [['parent_id'], 'integer'],
            [['obligation_q_1', 'obligation_q_2', 'obligation_q_3', 'obligation_q_4', 'total_obligation', 'disbursement_q_1', 'disbursement_q_2', 'disbursement_q_3', 'disbursement_q_4', 'total_disbursement'], 'number'],
            [['fiscal_year', 'fund_cluster', 'particulars', 'uacs_code', 'date_updated'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fiscal_year' => 'Fiscal Year',
            'fund_cluster' => 'Fund Cluster',
            'parent_id' => 'Parent MFO/PAP',
            'particulars' => 'Particulars',
            'uacs_code' => 'UACS Code',
            'obligation_q_1' => '1st Quarter Obligation',
            'obligation_q_2' => '2nd Quarter Obligation',
            'obligation_q_3' => '3rd Quarter Obligation',
            'obligation_q_4' => '4th Quarter Obligation',
            'total_obligation' => 'Total Obligation',
            'disbursement_q_1' => '1st Quarter Disbursement',
            'disbursement_q_2' => '2nd Quarter Disbursement',
            'disbursement_q_3' => '3rd Quarter Disbursement',
            'disbursement_q_4' => '4th Quarter Disbursement',
            'total_disbursement' => 'Total Disbursement',
        ];
    }
}
