<?php

namespace backend\models;

use yii\helpers\ArrayHelper;

use Yii;

/**
 * This is the model class for table "nca".
 *
 * @property int $id
 * @property string $date_received
 * @property string $nca_no
 * @property string $nca_type
 * @property string $fund_cluster
 * @property string $purpose
 * @property string $fiscal_year
 * @property string $mds_sub_acc_no
 * @property string $gsb_branch
 * @property string $january
 * @property string $february
 * @property string $march
 * @property string $first_quarter
 * @property string $april
 * @property string $may
 * @property string $june
 * @property string $second_quarter
 * @property string $july
 * @property string $august
 * @property string $september
 * @property string $third_quarter
 * @property string $october
 * @property string $november
 * @property string $december
 * @property string $forth_quarter
 * @property string $validity
 * @property string $total_amount
 *
 * @property Disbursement[] $disbursements
 * @property FundCluster $fundCluster
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
            [['date_received', 'nca_no', 'nca_type', 'fund_cluster', 'funding_source', 'purpose', 'fiscal_year', 'mds_sub_acc_no', 'gsb_branch', 'january', 'february', 'march', 'first_quarter', 'april', 'may', 'june', 'second_quarter', 'july', 'august', 'september', 'third_quarter', 'october', 'november', 'december', 'forth_quarter', 'validity', 'total_amount'], 'required'],
            [['january', 'february', 'march', 'first_quarter', 'april', 'may', 'june', 'second_quarter', 'july', 'august', 'september', 'third_quarter', 'october', 'november', 'december', 'forth_quarter', 'total_amount', 'sub_total'], 'number'],
            [['date_received', 'nca_type', 'funding_source', 'disbursement_date', 'fund_cluster', 'fiscal_year', 'mds_sub_acc_no'], 'string', 'max' => 100],
            [['nca_no', 'purpose', 'gsb_branch', 'validity'], 'string', 'max' => 200],
            [['fund_cluster'], 'exist', 'skipOnError' => true, 'targetClass' => FundCluster::className(), 'targetAttribute' => ['fund_cluster' => 'fund_cluster']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date_received' => 'Date',
            'nca_no' => 'NCA No',
            'nca_type' => 'NCA-type',
            'fund_cluster' => 'Fund Cluster',
            'purpose' => 'Purpose',
            'fiscal_year' => 'Fiscal Year',
            'mds_sub_acc_no' => 'MDS Sub-Account No.',
            'gsb_branch' => 'GSB Branch',
            'funding_source' => 'Funding Source Code',
            'january' => 'January',
            'february' => 'February',
            'march' => 'March',
            'first_quarter' => 'Total Amount for First Quarter',
            'april' => 'April',
            'may' => 'May',
            'june' => 'June',
            'second_quarter' => 'Total Amount for Second Quarter',
            'july' => 'July',
            'august' => 'August',
            'september' => 'September',
            'third_quarter' => 'Total Amount for Third Quarter',
            'october' => 'October',
            'november' => 'November',
            'december' => 'December',
            'forth_quarter' => 'Total Amount for Forth Quarter',
            'validity' => 'Validity Period',
            'total_amount' => 'Total Amount',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDisbursements()
    {
        return $this->hasMany(Disbursement::className(), ['nca' => 'nca_no']);
    }

    public function getEarmarked()
    {
        $total_earmarked = array_sum(ArrayHelper::getColumn(NcaEarmarked::find()
            ->where(['nca_no' => $this->nca_no, 'funding_source' => $this->funding_source])
            ->all(), 'amount'));

        return $total_earmarked;
    }

    public function getMearmarked($nca_no, $funding_source, $month)
    {
        $total_earmarked = array_sum(ArrayHelper::getColumn(NcaEarmarked::find()
            ->where(['nca_no' => $nca_no])
            ->andWhere(['funding_source' => $funding_source])
            ->andFilterWhere(['like', 'disbursement_date', $month])
            ->all(), 'amount'));

        return $total_earmarked;
    }

    public function getLastdate()
    {
        $date = NcaEarmarked::find()->where(['nca_no' => $this->nca_no])->orderBy(['id' => SORT_DESC])->one();

        return isset($date->date) ? $date->date : '-';
    }

    public function getAllocation($nca_no, $funding_source, $month)
    {
        $result = Nca::find()->where(['nca_no' => $nca_no])
                             ->andWhere(['funding_source' => $funding_source])->one();

        if($month == 'January')
        {
            return $result->january;
        }

        elseif($month == 'February')
        {
            return $result->february;
        }

        elseif($month == 'March')
        {
            return $result->march;
        }

        elseif($month == 'April')
        {
            return $result->april;
        }

        elseif($month == 'May')
        {
            return $result->may;
        }

        elseif($month == 'June')
        {
            return $result->june;
        }

        elseif($month == 'July')
        {
            return $result->july;
        }

        elseif($month == 'august')
        {
            return $result->august;
        }

        elseif($month == 'September')
        {
            return $result->september;
        }

        elseif($month == 'October')
        {
            return $result->october;
        }

        elseif($month == 'November')
        {
            return $result->november;
        }

        elseif($month == 'December')
        {
            return $result->december;
        }

        else{
            return 0.00;
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFundCluster()
    {
        return $this->hasOne(FundCluster::className(), ['fund_cluster' => 'fund_cluster']);
    }
}
