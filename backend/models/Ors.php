<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "ors".
 *
 * @property int $id
 * @property string $particular
 * @property string $ors_class
 * @property string $funding_source
 * @property string $ors_year
 * @property string $ors_month
 * @property string $ors_serial
 * @property string $mfo_pap
 * @property string $responsibility_center
 * @property string $amount
 */
class Ors extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ors';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['particular', 'ors_class', 'funding_source', 'ors_year', 'ors_month', 'ors_serial', 'mfo_pap', 'responsibility_center', 'amount'], 'required'],
            [['amount'], 'number'],
            [['particular'], 'string', 'max' => 200],
            [['ors_class', 'funding_source', 'ors_year', 'ors_month', 'ors_serial', 'mfo_pap', 'responsibility_center'], 'string', 'max' => 100],
        ];
    }

    public function getDatedv()
    {
        $dv_date = Disbursement::find()->where(['like', 'ors', $this->id])->one();

        return $dv_date;
        //return $this->hasOne(Disbursement::className(), ['like', ['ors', $this->id]]);
    }

    public function getObligationstatus()
    {
        $obligations = OrsRegistry::find()->where(['ors_id' => $this->id])->all();

        return $obligations;
        //return $this->hasOne(Disbursement::className(), ['like', ['ors', $this->id]]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'particular' => 'Particular',
            'ors_class' => 'Ors Class',
            'funding_source' => 'Funding Source',
            'ors_year' => 'Ors Year',
            'ors_month' => 'Ors Month',
            'ors_serial' => 'Ors Serial',
            'mfo_pap' => 'MFO-PAP',
            'responsibility_center' => 'Responsibility Center',
            'amount' => 'Amount',
        ];
    }
}
