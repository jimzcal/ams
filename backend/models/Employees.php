<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "employees".
 *
 * @property int $id
 * @property string $employee_id
 * @property string $name
 * @property string $password
 * @property string $biometrix
 * @property string $qr_code
 */
class Employees extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employees';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['employee_id', 'name', 'password', 'biometrix', 'qr_code', 'office', 'position'], 'required'],
            [['employee_id', 'name', 'password', 'biometrix', 'qr_code', 'office', 'position'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'employee_id' => 'Employee ID',
            'name' => 'Name',
            'position' => 'Position',
            'office' => 'Office',
            'password' => 'Password',
            'biometrix' => 'Biometrix',
            'qr_code' => 'Qr Code',
        ];
    }
}
