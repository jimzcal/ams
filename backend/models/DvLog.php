<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "dv_log".
 *
 * @property int $id
 * @property string $date
 * @property string $transaction
 * @property string $employee_id
 */
class DvLog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dv_log';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date', 'transaction', 'employee_id', 'dv_no'], 'required'],
            [['date'], 'safe'],
            [['transaction', 'employee_id', 'dv_no'], 'string', 'max' => 100],
        ];
    }

    public function getEmployee()
    {
        $employee = Employees::find()->where(['employee_id' => $this->employee_id])->one();

        return $employee->name;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Date',
            'transaction' => 'Transaction',
            'employee_id' => 'Employee ID',
        ];
    }
}
