<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "ors_registry".
 *
 * @property int $id
 * @property string $date
 * @property int $ors_id
 * @property string $dv_no
 * @property string $disbursement_date
 * @property string $fund_cluster
 * @property string $ors_class
 * @property string $funding_source
 * @property string $ors_year
 * @property string $ors_month
 * @property string $ors_serial
 * @property string $mfo_pap
 * @property string $responsibility_center
 * @property string $gross_amount
 * @property string $less_amount
 * @property string $net_amount
 *
 * @property Ors $ors
 */
class OrsRegistry extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ors_registry';
    }

    /**
     * @inheritdoc
     */
    public $ors_no, $lddap_check_no, $date_paid, $fiscal_year;
    public function rules()
    {
        return [
            [['date', 'ors_id', 'dv_no', 'disbursement_date', 'fund_cluster', 'ors_class', 'funding_source', 'ors_year', 'ors_month', 'ors_serial', 'mfo_pap', 'responsibility_center', 'obligation', 'payable', 'payment'], 'required'],
            [['ors_id'], 'integer'],
            [['obligation', 'payable', 'payment', 'fiscal_year'], 'number'],
            [['date', 'dv_no', 'disbursement_date', 'fund_cluster', 'ors_class', 'funding_source', 'ors_year', 'ors_month', 'ors_serial', 'mfo_pap', 'responsibility_center', 'date_paid',  'particular', 'lddap_check_no', 'fund_cluster', 'disbursement_date', 'ors_no'], 'string', 'max' => 100],
            [['ors_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ors::className(), 'targetAttribute' => ['ors_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Date',
            'ors_id' => 'Ors ID',
            'dv_no' => 'Dv No',
            'disbursement_date' => 'Disbursement Date',
            'fund_cluster' => 'Fund Cluster',
            'ors_class' => 'Ors Class',
            'funding_source' => 'Funding Source',
            'ors_year' => 'Ors Year',
            'ors_month' => 'Ors Month',
            'ors_serial' => 'Ors Serial',
            'mfo_pap' => 'Mfo Pap',
            'responsibility_center' => 'Responsibility Center',
            'obligation' => 'Obligation',
            'payable' => 'payable',
            'payment' => 'Payment',
        ];
    }

    // public function getOrsdetailes()
    // {
    //     $ors_details = Ors::find()->where(['id' => ])
    // }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrs()
    {
        return $this->hasOne(Ors::className(), ['id' => 'ors_id']);
    }

    public function getRegistry($year, $fund_cluster, $ors_class, $month)
    {
        $value = array_sum(ArrayHelper::getColumn(OrsRegistry::find()
                        ->where(['like', 'disbursement_date', $year])
                        ->andWhere(['ors_class'=> $ors_class])
                        ->andWhere(['fund_cluster'=> $fund_cluster])
                        ->andwhere(['like', 'disbursement_date', $month])
                        ->all(), 'payment'));

        return $value == 0.00 ? '-' : number_format($value, 2);
    }

    public function getJantotal($year, $fund_cluster, $month)
    {
        $value = array_sum(ArrayHelper::getColumn(OrsRegistry::find()
                            ->where(['like', 'disbursement_date', $year])
                            ->andWhere(['fund_cluster'=> $fund_cluster])
                            ->andwhere(['like', 'disbursement_date', $month])
                            ->all(), 'payment'));

        return $value == 0.00 ? '-' : number_format($value, 2);
    }

    public function getJancheck($year, $fund_cluster, $month)
    {
        $value = array_sum(ArrayHelper::getColumn(Disbursement::find()
                            ->where(['like', 'date', $year])
                            ->andWhere(['like', 'date', $month])
                            ->andWhere(['fund_cluster'=> $fund_cluster])
                            ->andWhere(['mode_of_payment' => 'mds_check'])
                            ->andWhere(['status' => 'Paid'])
                            ->all(), 'net_amount'));

        return $value == 0.00 ? '-' : number_format($value, 2);
    }

    public function getJanlddap($year, $fund_cluster, $month)
    {
        $value = array_sum(ArrayHelper::getColumn(Disbursement::find()
                            ->where(['like', 'date', $year])
                            ->andWhere(['fund_cluster'=> $fund_cluster])
                            ->andWhere(['like', 'date', $month])
                            ->andWhere(['mode_of_payment' => 'lldap_ada'])
                            ->andWhere(['status' => 'Paid'])
                            ->all(), 'net_amount'));

        return $value == 0.00 ? '-' : number_format($value, 2);
    }

    public function getJandisbursement($year, $fund_cluster, $month)
    {
        $value = array_sum(ArrayHelper::getColumn(Disbursement::find()
                            ->where(['like', 'date', $year])
                            ->andWhere(['fund_cluster'=> $fund_cluster])
                            ->andWhere(['like', 'date', $month])
                            ->andWhere(['status' => 'Paid'])
                            ->all(), 'net_amount'));

        return $value == 0.00 ? '-' : number_format($value, 2);
    }

    public function getBalance($ors_id)
    {
        $balance = array_sum(ArrayHelper::getColumn(OrsRegistry::find()->where(['ors_id' => $ors_id])->all(), 'payment'));

        return isset($balance) ? $balance : '';
    }

}
