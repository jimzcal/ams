<?php

namespace common\models;

use Yii;
use common\models\Album;

/**
 * This is the model class for table "tblalbum_image".
 *
 * @property integer $id
 * @property string $name
 * @property integer $album_id
 *
 * @property Tblalbum $album
 */
class Image extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tblalbum_image';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'album_id'], 'required'],
            [['album_id'], 'integer'],
            [['name'], 'string', 'max' => 145],
            [['album_id'], 'exist', 'skipOnError' => true, 'targetClass' => Album::className(), 'targetAttribute' => ['album_id' => 'id']],
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
            'album_id' => 'Album ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlbum()
    {
        return $this->hasOne(Album::className(), ['id' => 'album_id']);
    }
}
