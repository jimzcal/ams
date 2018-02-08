<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[Nca]].
 *
 * @see Nca
 */
class NcaQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Nca[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Nca|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
