<?php

use yii\db\Migration;

/**
 * Class m180724_110325_add_new_field_to_user
 */
class m180724_110325_add_new_field_to_user extends Migration
{
    /**
     * {@inheritdoc}
     */
     public function up()
    {
        $this->addColumn('{{%user}}', 'field', Schema::TYPE_STRING);
    }

    public function down()
    {
        $this->dropColumn('{{%user}}', 'field');
    }
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180724_110325_add_new_field_to_user cannot be reverted.\n";

        return false;
    }
    */
}
