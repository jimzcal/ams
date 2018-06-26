<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "nca_earmarked".
 *
 * @property int $id
 * @property string $date
 * @property string $dv_no
 * @property string $nca_no
 * @property string $funding_source
 * @property string $amount
 */
class NcaEarmarked extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'nca_earmarked';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date', 'dv_no', 'nca_no', 'funding_source', 'amount'], 'required'],
            [['date'], 'safe'],
            [['amount'], 'number'],
            [['dv_no', 'nca_no', 'funding_source'], 'string', 'max' => 100],
        ];
    }

    public function getEarmarked()
    {
        $total_earmarked = array_sum(ArrayHelper::getColumn(NcaEarmarked::find()
            ->where(['nca_no' => $this->nca_no])
            ->all(), 'amount'));

        return $total_earmarked;
    }

    public function getPayee()
    {
        $payee = Disbursement::find()->where(['dv_no' => $this->dv_no])->one();

        return $payee->payee;
    }

    public function getGross()
    {
        $gross = Disbursement::find()->where(['dv_no' => $this->dv_no])->one();

        return $gross->gross_amount;
    }

    public function getLess()
    {
        $less = Disbursement::find()->where(['dv_no' => $this->dv_no])->one();

        return $less->less_amount;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Date',
            'dv_no' => 'Dv No',
            'nca_no' => 'Nca No',
            'funding_source' => 'Funding Source',
            'amount' => 'Amount',
        ];
    }
}
