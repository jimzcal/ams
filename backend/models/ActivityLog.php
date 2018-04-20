<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "activity_log".
 *
 * @property int $id
 * @property string $particular
 * @property string $date_time
 * @property string $user
 */
class ActivityLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'activity_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['particular', 'date_time', 'user'], 'required'],
            [['particular'], 'string', 'max' => 200],
            [['date_time', 'user'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'particular' => 'Particular',
            'date_time' => 'Date Time',
            'user' => 'User',
        ];
    }
}
