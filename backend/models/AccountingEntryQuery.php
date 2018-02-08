<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[AccountingEntry]].
 *
 * @see AccountingEntry
 */
class AccountingEntryQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return AccountingEntry[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return AccountingEntry|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
