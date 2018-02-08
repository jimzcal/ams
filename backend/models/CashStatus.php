<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "cash_status".
 *
 * @property int $id
 * @property string $nca_no
 * @property string $dv_no
 * @property string $current_balance
 * @property string $disbursement_amount
 * @property string $balance
 *
 * @property Disbursement $dvNo
 */
class CashStatus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cash_status';
    }

    /**
     * @inheritdoc
     */
    public $balance, $beginning_balance, $remarks;
    public function rules()
    {
        return [
            [['nca_no', 'dv_no', 'current_balance', 'disbursement_amount'], 'required'],
            [['current_balance', 'balance' ,'disbursement_amount'], 'number'],
            [['nca_no', 'dv_no', 'remarks'], 'string', 'max' => 200],
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
            'nca_no' => 'NCA No.',
            'dv_no' => 'DV No',
            'current_balance' => 'Current Balance',
            'disbursement_amount' => 'Disbursement Amount',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDvNo()
    {
        return $this->hasOne(Disbursement::className(), ['dv_no' => 'dv_no']);
    }

    /**
     * @inheritdoc
     * @return CashStatusQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CashStatusQuery(get_called_class());
    }
}
