<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "nca".
 *
 * @property int $id
 * @property string $date
 * @property string $nca_no
 * @property string $fund_cluster
 * @property string $mds_sub_acc_no
 * @property string $gsb_branch
 * @property string $purpose
 * @property string $period
 * @property string $amount
 */
class Nca extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'nca';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date', 'nca_no', 'fund_cluster', 'mds_sub_acc_no', 'gsb_branch', 'purpose', 'period', 'amount'], 'required'],
            [['amount'], 'number'],
            [['date', 'fund_cluster', 'gsb_branch', 'period'], 'string', 'max' => 100],
            [['nca_no', 'mds_sub_acc_no', 'purpose'], 'string', 'max' => 200],
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
            'nca_no' => 'NCA No.',
            'fund_cluster' => 'Fund Cluster',
            'mds_sub_acc_no' => 'MDS Sub-Account No.',
            'gsb_branch' => 'GSB Branch',
            'purpose' => 'Purpose',
            'period' => 'Period',
            'amount' => 'Amount',
        ];
    }

    /**
     * @inheritdoc
     * @return NcaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new NcaQuery(get_called_class());
    }
}
