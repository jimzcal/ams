<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "cash_advance".
 *
 * @property integer $id
 * @property string $dv_no
 * @property string $date
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
    public function rules()
    {
        return [
            [['dv_no', 'date'], 'required'],
            [['dv_no', 'date'], 'string', 'max' => 100],
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
     * @return CashAdvanceQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CashAdvanceQuery(get_called_class());
    }
}
