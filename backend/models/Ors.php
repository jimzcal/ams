<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;
use backend\models\OrsRegistry;

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
            [['particular', 'ors_class', 'funding_source', 'ors_year', 'ors_month', 'ors_serial', 'mfo_pap', 'responsibility_center', 'obligation', 'object_code'], 'required'],
            [['obligation'], 'number'],
            [['particular'], 'string', 'max' => 200],
            [['ors_class', 'ors_month'], 'string', 'max' => 2],
            [['funding_source'], 'string', 'max' => 8],
            [['ors_year'], 'string', 'max' => 4],
            [['date', 'ors_serial', 'mfo_pap', 'responsibility_center', 'object_code'], 'string', 'max' => 100],
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

    public function getBalances()
    {
        $balance = array_sum(ArrayHelper::getColumn(OrsRegistry::find()
            ->where(['ors_id' => $this->id])
            ->all(), 'payment'));

        return $balance;
        //return $this->hasOne(Disbursement::className(), ['like', ['ors', $this->id]]);
    }

    public function getDisbursement($ors_id)
    {
        $disbursement = array_sum(ArrayHelper::getColumn(OrsRegistry::find()
            ->where(['ors_id' => $ors_id])
            ->all(), 'payment'));

        return $disbursement;
    }

    public function getDate($ors_id)
    {
        $as_of = OrsRegistry::find()
            ->where(['ors_id' => $ors_id])
            ->orderBy(['id' => SORT_DESC])
            ->one();

        return isset($as_of->date) == true ? $as_of->date : '-';
    }

    public function getBalance($ors_id)
    {
        $balance = array_sum(ArrayHelper::getColumn(OrsRegistry::find()->where(['ors_id' => $ors_id])->all(), 'payment'));

        return isset($balance) ? $balance : '';
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
            'object_code' => 'Object Code',
            'mfo_pap' => 'MFO-PAP',
            'responsibility_center' => 'Responsibility Center',
            'obligation' => 'Obligation',
        ];
    }
}
