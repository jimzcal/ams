<?php

namespace common\models;

use Yii;
use common\models\Feature;
use common\models\Content;

/**
 * This is the model class for table "tblgroup".
 *
 * @property integer $id
 * @property integer $feature_id
 *
 * @property Tblcontent[] $tblcontents
 * @property Tblfeature $feature
 */
class Group extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tblgroup';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['feature_id'], 'required'],
            [['feature_id'], 'integer'],
            [['feature_id'], 'exist', 'skipOnError' => true, 'targetClass' => Feature::className(), 'targetAttribute' => ['feature_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'feature_id' => 'Feature ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContents()
    {
        return $this->hasMany(Content::className(), ['group_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFeature()
    {
        return $this->hasOne(Feature::className(), ['id' => 'feature_id']);
    }
}
