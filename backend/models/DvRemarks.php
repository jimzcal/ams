<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "dv_remarks".
 *
 * @property int $id
 * @property string $dv_no
 * @property int $user_id
 * @property string $remarks
 * @property string $date
 * @property string $snapshots
 *
 * @property User $user
 */
class DvRemarks extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dv_remarks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dv_no', 'user_id', 'remarks', 'date', 'snapshots'], 'required'],
            [['user_id'], 'integer'],
            [['remarks'], 'string'],
            [['date'], 'safe'],
            [['dv_no'], 'string', 'max' => 100],
            [['snapshots'], 'string', 'max' => 500],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'dv_no' => 'Dv No',
            'user_id' => 'User ID',
            'remarks' => 'Remarks',
            'date' => 'Date',
            'snapshots' => 'Snapshots',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
