<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "mdp".
 *
 * @property int $id
 * @property string $fiscal_year
 * @property string $particulars
 * @property string $uacs_code
 * @property string $parent_uacs
 * @property string $total_program
 * @property string $tra
 * @property string $net_program
 * @property string $january
 * @property string $february
 * @property string $march
 * @property string $first_total
 * @property string $april
 * @property string $may
 * @property string $june
 * @property string $second_total
 * @property string $july
 * @property string $august
 * @property string $september
 * @property string $third_total
 * @property string $october
 * @property string $november
 * @property string $december
 * @property string $forth_total
 * @property string $full_year_total
 */
class Mdp extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mdp';
    }

    /**
     * {@inheritdoc}
     */
    public $file;

    public function rules()
    {
        return [
            [['fiscal_year', 'version', 'file'], 'required'],
            [['total_program', 'tra', 'net_program', 'january', 'february', 'march', 'first_total', 'april', 'may', 'june', 'second_total', 'july', 'august', 'september', 'third_total', 'october', 'november', 'december', 'forth_total', 'full_year_total'], 'number'],
            [['fiscal_year', 'uacs_code', 'parent_uacs', 'version'], 'string', 'max' => 100],
            [['file'], 'file', 'skipOnEmpty' => false, 'extensions' => 'xlsx'],
            [['particulars'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fiscal_year' => 'Fiscal Year',
            'version' => 'Version',
            'mdp_file' => 'MDP Excel File',
            'particulars' => 'Particulars',
            'uacs_code' => 'Uacs Code',
            'parent_uacs' => 'Parent Uacs',
            'total_program' => 'Total Program',
            'tra' => 'Tax Rem. Advice',
            'net_program' => 'Net Program',
            'january' => 'January',
            'february' => 'February',
            'march' => 'March',
            'first_total' => 'Quarter 1',
            'april' => 'April',
            'may' => 'May',
            'june' => 'June',
            'second_total' => 'Quarter 2',
            'july' => 'July',
            'august' => 'August',
            'september' => 'September',
            'third_total' => 'Quarter 3',
            'october' => 'October',
            'november' => 'November',
            'december' => 'December',
            'forth_total' => 'Quarter 4',
            'full_year_total' => 'Full Year Total',
        ];
    }

    public function getValidating($fiscal_year, $version)
    {
        $result = Mdp::findOne(['fiscal_year' => $fiscal_year, 'version' => $version]);

        return $result != null ? $result : null;
    }

    public function getChild($fiscal_year, $uacs_code, $version)
    {
        $result = Mdp::find()->where(['parent_uacs' => $uacs_code, 'fiscal_year' => $fiscal_year, 'version' => $version])->all();

        return $result != null ? $result : null;
    }
}
