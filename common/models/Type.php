<?php

namespace common\models;

use Yii;
use common\models\Attribute;

/**
 * This is the model class for table "tbltype".
 *
 * @property integer $id
 * @property string $name
 *
 * @property Tblattribute[] $tblattributes
 */
class Type extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbltype';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblattributes()
    {
        return $this->hasMany(Attribute::className(), ['type_id' => 'id']);
    }
}
