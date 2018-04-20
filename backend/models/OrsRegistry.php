<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "ors_registry".
 *
 * @property int $id
 * @property string $date
 * @property string $ors_class
 * @property string $funding_source
 * @property string $ors_year
 * @property string $ors_month
 * @property string $ors_serial
 * @property string $mfo_pap
 * @property string $responsibility_center
 * @property string $gross_amount
 * @property string $less_amount
 * @property string $net_amount
 */
class OrsRegistry extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ors_registry';
    }

    /**
     * @inheritdoc
     */
    public $ors_no, $lddap_check_no, $date_paid;

    public function rules()
    {
        return [
            [['mfo_pap', 'responsibility_center', 'gross_amount', 'less_amount', 'net_amount'], 'required'],
            [['id','gross_amount', 'less_amount', 'net_amount'], 'number'],
            [['date', 'ors_class', 'funding_source', 'ors_year', 'ors_month', 'ors_serial', 'mfo_pap', 'responsibility_center', 'dv_no', 'ors_no', 'date_paid', 'lddap_check_no'], 'string', 'max' => 100],
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
            'ors_class' => 'ORS Class',
            'ors_no' => 'ORS No.',
            'lddap_check_no' => 'LDDAP-ADA/CHECK NO.',
            'date_paid' => 'Date Paid',
            'funding_source' => 'Funding Source',
            'ors_year' => 'ORS Year',
            'ors_month' => 'ORS Month',
            'ors_serial' => 'ORS Serial',
            'mfo_pap' => 'MFO/PAP',
            'responsibility_center' => 'Responsibility Center',
            'gross_amount' => 'Gross Amount',
            'less_amount' => 'Less Amount',
            'net_amount' => 'Net Amount',
        ];
    }
}
