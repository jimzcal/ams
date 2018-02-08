<?php

namespace common\models;

use Yii;
use common\models\Group;

/**
 * This is the model class for table "tblcontent".
 *
 * @property integer $id
 * @property string $attribute
 * @property string $value
 * @property integer $group_id
 *
 * @property Tblgroup $group
 */
class Content extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tblcontent';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['attribute', 'value', 'group_id'], 'required'],
            [['value'], 'string'],
            [['group_id'], 'integer'],
            [['attribute'], 'string', 'max' => 45],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => Group::className(), 'targetAttribute' => ['group_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'attribute' => 'Attribute',
            'value' => 'Value',
            'group_id' => 'Group ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(Group::className(), ['id' => 'group_id']);
    }
}
