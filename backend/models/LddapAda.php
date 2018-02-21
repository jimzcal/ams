<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "lddap_ada".
 *
 * @property int $id
 * @property string $date
 * @property string $lddap_no
 * @property string $dv_no
 * @property string $current_account
 * @property string $uacs_code
 * @property string $net_amount
 * @property string $remarks
 *
 * @property Disbursement $dvNo
 */
class LddapAda extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lddap_ada';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date', 'lddap_no', 'dv_no', 'current_account', 'uacs_code', 'net_amount', 'remarks'], 'required'],
            [['net_amount'], 'number'],
            [['date', 'lddap_no', 'dv_no', 'uacs_code', 'remarks'], 'string', 'max' => 100],
            [['current_account'], 'string', 'max' => 200],
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
            'date' => 'Date',
            'lddap_no' => 'Lddap No',
            'dv_no' => 'Dv No',
            'current_account' => 'Current Account',
            'uacs_code' => 'Uacs Code',
            'net_amount' => 'Net Amount',
            'remarks' => 'Remarks',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDv()
    {
        return $this->hasOne(Disbursement::className(), ['dv_no' => 'dv_no']);
    }

    /**
     * @inheritdoc
     * @return LddapAdaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LddapAdaQuery(get_called_class());
    }
}
