<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "cash_advance".
 *
 * @property int $id
 * @property string $dv_no
 * @property string $date
 * @property string $due_date
 * @property string $status
 * @property string $date_liquidated
 *
 * @property Disbursement $dvNo
 */
class CashAdvance extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cash_advance';
    }

    /**
     * @inheritdoc
     */
    public $payee, $amount;
    public function rules()
    {
        return [
            [['dv_no', 'date', 'due_date', 'status', 'date_liquidated'], 'required'],
            [['dv_no', 'date', 'due_date', 'status', 'date_liquidated', 'payment_method'], 'string', 'max' => 100],
            [['amount_paid'], 'number'],
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
            'dv_no' => 'Dv No',
            'date' => 'Date',
            'due_date' => 'Due Date',
            'status' => 'Status',
            'date_liquidated' => 'Date Liquidated',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDvNo()
    {
        return $this->hasOne(Disbursement::className(), ['dv_no' => 'dv_no']);
    }

    public function getDisbursed()
    {
        return $this->hasOne(DisbursedDv::className(), ['dv_no' => 'dv_no']);
    }
}
