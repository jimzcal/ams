<?php

namespace common\models;

use Yii;
use common\models\Group;

/**
 * This is the model class for table "tblfeature".
 *
 * @property integer $id
 * @property string $name
 * @property string $attributes
 * @property integer $isVisible
 *
 * @property Tblgroup[] $tblgroups
 */
class Feature extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tblfeature';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'attributes', 'isVisible'], 'required'],
            [['attributes'], 'string'],
            [['isVisible'], 'integer'],
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
            'attributes' => 'Attributes',
            'isVisible' => 'Is Visible',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroups()
    {
        return $this->hasMany(Group::className(), ['feature_id' => 'id']);
    }
}
