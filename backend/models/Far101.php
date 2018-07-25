<?php

namespace backend\models;
use yii\helpers\ArrayHelper;
use backend\models\OrsRegistry;

use Yii;

/**
 * This is the model class for table "far_1_01".
 *
 * @property int $id
 * @property string $date_updated
 * @property string $fiscal_year
 * @property string $fund_cluster
 * @property int $parent_id
 * @property string $particulars
 * @property string $uacs_code
 * @property string $authorized_appropriation
 * @property string $adjustment_authorization
 * @property string $adjusted_appropriation
 * @property string $allotment_received
 * @property string $allotment_adjustment
 * @property string $transafer_to
 * @property string $transfer_from
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
 * @property string $unreleased_balance
 * @property string $unobligated_balance
 * @property string $due_unpaid
 * @property string $not_yet_due
 */
class Far101 extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'far_1_01';
    }

    /**
     * {@inheritdoc}
     */
    public $file;

    public function rules()
    {
        return [
            [['fiscal_year', 'fund_cluster', 'file'], 'required'],
            [['file'], 'file', 'skipOnEmpty' => false, 'extensions' => 'xlsx'],
            [['authorized_appropriation', 'adjustment_appropriation', 'adjusted_appropriation', 'allotment_received', 'allotment_adjustment', 'obligation_q_1', 'obligation_q_2', 'obligation_q_3', 'obligation_q_4', 'total_obligation', 'disbursement_q_1', 'disbursement_q_2', 'disbursement_q_3', 'disbursement_q_4', 'total_disbursement', 'unreleased_balance', 'id', 'unobligated_balance', 'due_unpaid', 'not_yet_due'], 'number'],
            [['date_updated', 'fiscal_year', 'fund_cluster', 'particulars', 'uacs_code', 'transfer_to', 'transfer_from', 'parent_uacs'], 'string', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date_updated' => 'Date Updated',
            'fiscal_year' => 'Fiscal Year',
            'fund_cluster' => 'Fund Cluster',
            'parent_UACS' => 'Parent UACS Code',
            'particulars' => 'Particulars',
            'uacs_code' => 'Uacs Code',
            'authorized_appropriation' => 'Authorized Appropriation',
            'adjustment_appropriation' => 'Adjustment Appropriation',
            'adjusted_appropriation' => 'Adjusted Appropriation',
            'allotment_received' => 'Allotment Received',
            'allotment_adjustment' => 'Allotment Adjustment',
            'transafer_to' => 'Transafer To',
            'transfer_from' => 'Transfer From',
            'obligation_q_1' => 'Obligation Q 1',
            'obligation_q_2' => 'Obligation Q 2',
            'obligation_q_3' => 'Obligation Q 3',
            'obligation_q_4' => 'Obligation Q 4',
            'total_obligation' => 'Total Obligation',
            'disbursement_q_1' => 'Disbursement Q 1',
            'disbursement_q_2' => 'Disbursement Q 2',
            'disbursement_q_3' => 'Disbursement Q 3',
            'disbursement_q_4' => 'Disbursement Q 4',
            'total_disbursement' => 'Total Disbursement',
            'unreleased_balance' => 'Unreleased Balance',
            'unobligated_balance' => 'Unobligated Balance',
            'due_unpaid' => 'Due Unpaid',
            'not_yet_due' => 'Not Yet Due',
        ];
    }

    public function getValidating($fiscal_year, $fund_cluster)
    {
        $result = Far101::find()->where(['fiscal_year' => $fiscal_year])->andWhere(['fund_cluster' => $fund_cluster])->one();

        return $result == null ? null : 'positive';
    }

    public function getDisbursement1($fiscal_year, $fund_cluster, $uacs_code, $parent_uacs)
    {
        if(($uacs_code == '01') || ($uacs_code == '02') || ($uacs_code == '03') || ($uacs_code == '04'))
        {
            $result = array_sum(ArrayHelper::getColumn(OrsRegistry::find(['payment'])
                    ->where(['mfo_pap'=>$parent_uacs])
                    ->andWhere(['ors_year'=>$fiscal_year])
                    ->andWhere(['ors_class'=>$uacs_code])
                    ->andWhere(['fund_cluster' => $fund_cluster])
                    ->andFilterWhere(['or', ['like', 'disbursement_date', 'January'],
                                ['like', 'disbursement_date', 'February'],
                                ['like', 'disbursement_date', 'March']
                            ])
                    ->all(), 'payment')); 

            return $result != null ? $result : 0.00;
        }

        else
        {
            $result = array_sum(ArrayHelper::getColumn(OrsRegistry::find(['payment'])
                    ->where(['mfo_pap'=>$uacs_code])
                    ->andWhere(['ors_year'=>$fiscal_year])
                    ->andWhere(['fund_cluster' => $fund_cluster])
                    ->andFilterWhere(['or', ['like', 'disbursement_date', 'January'],
                                ['like', 'disbursement_date', 'February'],
                                ['like', 'disbursement_date', 'March']
                            ])
                    ->all(), 'payment')); 

            return $result != null ? $result : 0.00;
        }
    }

    public function getDisbursement2($fiscal_year, $fund_cluster, $uacs_code, $parent_uacs)
    {
        if(($uacs_code == '01') || ($uacs_code == '02') || ($uacs_code == '03') || ($uacs_code == '04'))
        {
            $result = array_sum(ArrayHelper::getColumn(OrsRegistry::find(['payment'])
                    ->where(['mfo_pap'=>$parent_uacs])
                    ->andWhere(['ors_year'=>$fiscal_year])
                    ->andWhere(['ors_class'=>$uacs_code])
                    ->andWhere(['fund_cluster' => $fund_cluster])
                    ->andFilterWhere(['or', ['like', 'disbursement_date', 'April'],
                                ['like', 'disbursement_date', 'May'],
                                ['like', 'disbursement_date', 'June']
                            ])
                    ->all(), 'payment')); 

            return $result != null ? $result : 0.00;
        }

        else
        {
             $result = array_sum(ArrayHelper::getColumn(OrsRegistry::find(['payment'])
                    ->where(['mfo_pap'=>$uacs_code])
                    ->andWhere(['ors_year'=>$fiscal_year])
                    ->andWhere(['fund_cluster' => $fund_cluster])
                    ->andFilterWhere(['or', ['like', 'disbursement_date', 'April'],
                                ['like', 'disbursement_date', 'May'],
                                ['like', 'disbursement_date', 'June']
                            ])
                    ->all(), 'payment')); 

            return $result != null ? $result : 0.00;
        }
    }

    public function getDisbursement3($fiscal_year, $fund_cluster, $uacs_code, $parent_uacs)
    {
        if(($uacs_code == '01') || ($uacs_code == '02') || ($uacs_code == '03') || ($uacs_code == '04'))
        {
            $result = array_sum(ArrayHelper::getColumn(OrsRegistry::find(['payment'])
                    ->where(['mfo_pap'=>$parent_uacs])
                    ->andWhere(['ors_year'=>$fiscal_year])
                    ->andWhere(['ors_class'=>$uacs_code])
                    ->andWhere(['fund_cluster' => $fund_cluster])
                    ->andFilterWhere(['or', ['like', 'disbursement_date', 'July'],
                                ['like', 'disbursement_date', 'August'],
                                ['like', 'disbursement_date', 'September']
                            ])
                    ->all(), 'payment')); 

            return $result != null ? $result : 0.00;
        }

        else
        {
            $result = array_sum(ArrayHelper::getColumn(OrsRegistry::find(['payment'])
                    ->where(['mfo_pap'=>$uacs_code])
                    ->andWhere(['ors_year'=>$fiscal_year])
                    ->andWhere(['fund_cluster' => $fund_cluster])
                    ->andFilterWhere(['or', ['like', 'disbursement_date', 'July'],
                                ['like', 'disbursement_date', 'August'],
                                ['like', 'disbursement_date', 'September']
                            ])
                    ->all(), 'payment')); 

            return $result != null ? $result : 0.00;
        }
    }

    public function getDisbursement4($fiscal_year, $fund_cluster, $uacs_code, $parent_uacs)
    {
        if(($uacs_code == '01') || ($uacs_code == '02') || ($uacs_code == '03') || ($uacs_code == '04'))
        {
            $result = array_sum(ArrayHelper::getColumn(OrsRegistry::find(['payment'])
                    ->where(['mfo_pap'=>$parent_uacs])
                    ->andWhere(['ors_year'=>$fiscal_year])
                    ->andWhere(['ors_class'=>$uacs_code])
                    ->andWhere(['fund_cluster' => $fund_cluster])
                    ->andFilterWhere(['or', ['like', 'disbursement_date', 'October'],
                                ['like', 'disbursement_date', 'November'],
                                ['like', 'disbursement_date', 'December']
                            ])
                    ->all(), 'payment')); 

            return $result != null ? $result : 0.00;
        }

        else
        {
            $result = array_sum(ArrayHelper::getColumn(OrsRegistry::find(['payment'])
                    ->where(['mfo_pap'=>$uacs_code])
                    ->andWhere(['ors_year'=>$fiscal_year])
                    ->andWhere(['fund_cluster' => $fund_cluster])
                    ->andFilterWhere(['or', ['like', 'disbursement_date', 'October'],
                                ['like', 'disbursement_date', 'November'],
                                ['like', 'disbursement_date', 'December']
                            ])
                    ->all(), 'payment')); 

            return $result != null ? $result : 0.00;
        }
    }

    public function getDisbursementtotal($fiscal_year, $fund_cluster, $uacs_code, $parent_uacs)
    {
        if(($uacs_code == '01') || ($uacs_code == '02') || ($uacs_code == '03') || ($uacs_code == '04'))
        {
            $result = array_sum(ArrayHelper::getColumn(OrsRegistry::find(['payment'])
                    ->where(['mfo_pap'=>$parent_uacs])
                    ->andWhere(['ors_year'=>$fiscal_year])
                    ->andWhere(['ors_class'=>$uacs_code])
                    ->andWhere(['fund_cluster' => $fund_cluster])
                    ->all(), 'payment')); 

            return $result != null ? $result : 0.00;
        }

        else
        {
            $result = array_sum(ArrayHelper::getColumn(OrsRegistry::find(['payment'])
                    ->where(['mfo_pap'=>$uacs_code])
                    ->andWhere(['ors_year'=>$fiscal_year])
                    ->andWhere(['fund_cluster' => $fund_cluster])
                    ->all(), 'payment')); 

            return $result != null ? $result : 0.00;
        }
    }
}
