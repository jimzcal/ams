<?php

namespace backend\models;

use Yii;

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
    public $date_paid, $check_no, $lddap_check_no, $page_checker;
    public $dvs;
    public function rules()
    {
        return [
            [['dv_no', 'ors_class', 'ors_year', 'ors_month', 'fund_cluster', 'ors_serial', 'cash_advance', 'date', 'payee', 'particulars', 'nca', 'responsibility_center', 'mfo_pap', 'gross_amount', 'tin', 'transaction_id', 'status'], 'required'],
            [['particulars', 'attachments', 'remarks'], 'string'],
            [['gross_amount', 'less_amount', 'net_amount'], 'number', 'numberPattern' => '/^\s*[-+]?[0-9]*[.,]?[0-9]+([eE][-+]?[0-9]+)?\s*$/'],
            [['transaction_id'], 'integer'],
            [['dv_no', 'payee', 'nca'], 'string', 'max' => 200],
            [['date', 'date_paid', 'check_no', 'lddap_check_no', 'cash_advance', 'fund_cluster', 'mode_of_payment', 'responsibility_center', 'mfo_pap', 'tin', 'ors_class', 'status', 'ors_year', 'ors_month', 'ors_serial', 'obligated'], 'string', 'max' => 100],
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
            'nca' => 'NCA',
            'responsibility_center' => 'Responsibility Center',
            'mfo_pap' => 'MFO/PAP',
            'gross_amount' => 'Gross Amount',
            'cash_advance' => 'Cash Advance?',
            'less_amount' => 'Less Amount',
            'net_amount' => 'Net Amount',
            'fund_cluster' => 'Fund Cluster',
            'fund_source' => 'Fund Source',
            'ors_no' => 'ORS No',
            'transaction_id' => 'Transaction Type',
            'attachments' => 'Attachments',
            'remarks' => 'Remarks',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountingEntries()
    {
        return $this->hasMany(AccountingEntry::className(), ['dv_no' => 'dv_no']);
    }

    public function getFundCluster()
    {
        return $this->hasMany(FundCluster::className(), ['fund_cluster' => 'fund_cluster']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCashAdvances()
    {
        return $this->hasMany(CashAdvance::className(), ['dv_no' => 'dv_no']);
    }

    public function getAccountingEntry()
    {
        return $this->hasOne(AccountingEntry::className(), ['dv_no' => 'dv_no']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactionStatuses()
    {
        return $this->hasMany(TransactionStatus::className(), ['dv_no' => 'dv_no']);
    }
}
