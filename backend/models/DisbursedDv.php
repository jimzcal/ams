<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "disbursed_dv".
 *
 * @property int $id
 * @property string $dv_no
 * @property string $date_paid
 * @property string $lddap_check_no
 */
class DisbursedDv extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'disbursed_dv';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dv_no', 'date_paid', 'lddap_check_no'], 'required'],
            [['dv_no', 'date_paid', 'lddap_check_no'], 'string', 'max' => 100],
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
            'date_paid' => 'Date Paid',
            'lddap_check_no' => 'Lddap Check No',
        ];
    }

    /**
     * @inheritdoc
     * @return DisbursedDvQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DisbursedDvQuery(get_called_class());
    }
}
