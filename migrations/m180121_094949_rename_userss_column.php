<?php

use yii\db\Migration;

/**
 * Class m180121_094949_rename_userss_column
 */
class m180121_094949_rename_userss_column extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->renameColumn('users', 'nickname', 'username');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->renameColumn('users', 'username', 'nickname');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180121_094949_rename_userss_column cannot be reverted.\n";

        return false;
    }
    */
}
