<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;
use backend\models\NcaEarmarked;

/**
 * This is the model class for table "disbursement".
 *
 * @property integer $id
 * @property string $dv_no
 * @property string $date
 * @property string $payee
 * @property string $particulars
 * @property string $mode_of_payment
 * @property string $nca
 * @property string $responsibility_center
 * @property string $mfo_pap
 * @property string $gross_amount
 * @property string $less_amount
 * @property string $net_amount
 * @property string $fund_source
 * @property string $ors_no
 * @property integer $transaction_id
 * @property string $attachments
 * @property string $remarks
 * @property string $status
 *
 * @property AccountingEntry[] $accountingEntries
 * @property CashAdvance[] $cashAdvances
 * @property TransactionStatus[] $transactionStatuses
 */
class Disbursement extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'disbursement';
    }



    /**
     * @inheritdoc
     */
    public $date_paid, $check_no, $lddap_check_no, $page_checker, $particular, $amount, $lddap_no, $ors_no, $ors_id;
    public $dvs, $responsibility_center, $ors_class, $ors_year, $ors_month, $ors_serial, $mfo_pap, $due, $period, $employee_id, $payable, $obligation, $payment, $nca_id, $nca_no, $funding_source, $date_registry, $action, $remarks, $nca;

    public function rules()
    {
        return [
            [['dv_no', 'fund_cluster', 'particulars', 'date', 'payee', 'gross_amount', 'transaction_id', 'ors_no'], 'required'],
            [['dv_no'], 'unique', 'targetAttribute' => ['dv_no']],
            [['attachments', 'funding_source', 'remarks', 'particulars', 'particular', 'lddap_no', 'mfo_pap', 'responsibility_center', 'nca_no', 'action'], 'string'],
            [['gross_amount', 'amount', 'less_amount', 'net_amount', 'obligation', 'payable'], 'number'],
            [['payment'], 'number', 'numberPattern' => '[0-9]*[,]?[0-9]?[0.00]'],
            // [['gross_amount', 'amount', 'less_amount', 'net_amount'], 'number', 'numberPattern' => '[0-9]*[,]?[0-9]?[0.00]'],
            [['transaction_id', 'ors_id', 'ors', 'nca_id'], 'integer'],
            [['date_registry'], 'date'],
            [['payee', 'particulars'], 'exist', 'targetClass' => Disbursement::class, 'targetAttribute' => ['payee' => 'payee', 'particulars' => 'particulars']],
            //[['ors'], 'safe'],
            [['dv_no', 'payee', 'nca'], 'string', 'max' => 200],
            [['date', 'date_paid', 'check_no', 'lddap_check_no', 'cash_advance', 'fund_cluster', 'mode_of_payment', 'tin', 'obligated', 'funding_source', 'employee_id', 'period'], 'string', 'max' => 100],
            [['dv_no'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'dv_no' => 'DV No',
            'date' => 'Date',
            'payee' => 'Payee',
            'particulars' => 'Particulars',
            'mode_of_payment' => 'Mode Of Payment',
            'nca' => 'NCA No.',
            'responsibility_center' => 'Responsibility Center',
            'mfo_pap' => 'MFO/PAP',
            'gross_amount' => 'Gross Amount',
            'cash_advance' => 'Cash Advance?',
            'lddap_check_no' => 'LDDAP-ADA/Check No.',
            'less_amount' => 'Less Amount',
            'net_amount' => 'Net Amount',
            'fund_cluster' => 'Fund Cluster',
            'funding_source' => 'Funding Source',
            'ors_no' => 'ORS No',
            'ors' => 'ORS No.',
            'transaction_id' => 'Transaction Type',
            'attachments' => 'Attachments',
            'remarks' => 'Remarks',
            'status' => 'Status',
            'tin' => 'TIN',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountingEntries()
    {
        return $this->hasMany(AccountingEntry::className(), ['dv_no' => 'dv_no']);
    }

    public function getCluster()
    {
        return $this->hasOne(FundCluster::className(), ['fund_cluster' => 'fund_cluster']);
    }

    public function getTransaction()
    {
        return $this->hasOne(Transaction::className(), ['id' => 'transaction_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCashAdvances()
    {
        return $this->hasMany(CashAdvance::className(), ['dv_no' => 'dv_no']);
    }

    public function getCheck($nca_no, $funding_source)
    {
        $yes = NcaEarmarked::find()->where(['dv_no' => $this->dv_no])
                ->andWhere(['nca_no' => $nca_no])
                ->andWhere(['funding_source' => $funding_source])
                ->one();

        return isset($yes) ? "checked" : "unchecked";
    }

    public function getEarmarkedamount($nca_no, $funding_source)
    {
        $amount = NcaEarmarked::find()->where(['dv_no' => $this->dv_no])
                ->andWhere(['nca_no' => $nca_no])
                ->andWhere(['funding_source' => $funding_source])
                ->one();

        return isset($amount) ? $amount->amount : '';
    }

    public function getAccountingEntry()
    {
        return $this->hasOne(AccountingEntry::className(), ['dv_no' => 'dv_no']);
    }

    public function getOrs()
    {
        return $this->hasOne(Ors::className(), ['dv_no' => 'dv_no']);
    }

    public function getLog()
    {
        return $this->hasOne(DvLog::className(), ['dv_no' => 'dv_no']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactionStatuses()
    {
        return $this->hasMany(TransactionStatus::className(), ['dv_no' => 'dv_no']);
    }

    public function getRemarkss()
    {
        return $this->hasMany(DvRemarks::className(), ['dv_no' => 'dv_no']);
    }

    public function getRemark()
    {
        $remark = DvRemarks::find()
            ->where(['dv_no' => $this->dv_no])
            ->andWhere(['user_id' => Yii::$app->user->identity->id])
            ->one();

        return isset($remark->remarks) ? $remark->remarks : '' ;
    }

    public function getAda()
    {
        return $this->hasOne(LddapAda::className(), ['dv_no' => 'dv_no']);
    }

    public function getObligationbalance($ors_id)
    {
        $balance = array_sum(ArrayHelper::getColumn(OrsRegistry::find()
            ->where(['ors_id' => $ors_id])
            ->all(), 'payment'));

        return $balance;
    }

    public function getValidating($payee, $particulars, $gross_amount)
    {
        $result = Disbursement::findOne(['payee' => $payee, 'particulars' => $particulars, 'gross_amount' => $gross_amount]);

        return $result != null ? $result->dv_no : null;
    }

    public function getEarmarked($nca_no, $funding_source)
    {
        $earmarked_amount = array_sum(ArrayHelper::getColumn(NcaEarmarked::find()
                    ->where(['nca_no' => $nca_no])
                    ->andWhere(['funding_source' => $funding_source])
                    ->all(), 'amount'));

        return $earmarked_amount;
    }
}