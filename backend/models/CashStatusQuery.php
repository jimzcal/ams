<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[CashStatus]].
 *
 * @see CashStatus
 */
class CashStatusQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return CashStatus[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CashStatus|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
