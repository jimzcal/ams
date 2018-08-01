<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "inbox".
 *
 * @property int $id
 * @property string $dv_no
 * @property string $date
 * @property string $user_role
 * @property int $status
 */
class Inbox extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'inbox';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dv_no', 'date', 'user_role', 'status'], 'required'],
            [['date'], 'safe'],
            [['status'], 'integer'],
            [['dv_no', 'user_role'], 'string', 'max' => 100],
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
            'date' => 'Date',
            'user_role' => 'User Role',
            'status' => 'Status',
        ];
    }
}
