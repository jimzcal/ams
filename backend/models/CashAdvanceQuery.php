<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[CashAdvance]].
 *
 * @see CashAdvance
 */
class CashAdvanceQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return CashAdvance[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CashAdvance|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
