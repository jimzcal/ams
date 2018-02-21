<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "accounting_entry".
 *
 * @property int $id
 * @property string $dv_no
 * @property string $account_title
 * @property string $uacs_code
 * @property double $debit
 * @property double $credit_amount
 * @property string $credit_to
 *
 * @property Disbursement $dvNo
 */
class AccountingEntry extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'accounting_entry';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dv_no', 'account_title', 'uacs_code', 'credit_amount'], 'required'],
            [['debit', 'credit_amount'], 'number'],
            [['vat'], 'number'],
            [['dv_no', 'credit_to'], 'string', 'max' => 100],
            [['account_title', 'uacs_code'], 'string', 'max' => 200],
            [['dv_no'], 'exist', 'skipOnError' => true, 'targetClass' => Disbursement::className(), 'targetAttribute' => ['dv_no' => 'dv_no']],
        ];
    }

    /**
     * @inheritdoc
     */
    
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'dv_no' => 'DV No.',
            'account_title' => 'Account Title',
            'uacs_code' => 'UACS Code',
            'debit' => 'Debit',
            'credit_amount' => 'Credit Amount',
            'credit_to' => 'Credit To',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDvNo()
    {
        return $this->hasOne(Disbursement::className(), ['dv_no' => 'dv_no']);
    }

    public function getDisbursement()
    {
        return $this->hasOne(Disbursement::className(), ['dv_no' => 'dv_no']);
    }

    /**
     * @inheritdoc
     * @return AccountingEntryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AccountingEntryQuery(get_called_class());
    }
}
