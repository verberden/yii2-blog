<?php

use yii\db\Migration;

/**
 * Class m180121_165934_add_users_column
 */
class m180121_165934_add_users_column extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn('users', 'email','string unique');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropColumn('users', 'email');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180121_165934_add_users_column cannot be reverted.\n";

        return false;
    }
    */
}
