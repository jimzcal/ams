<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[LddapAda]].
 *
 * @see LddapAda
 */
class LddapAdaQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return LddapAda[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return LddapAda|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
