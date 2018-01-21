<?php

use yii\db\Migration;

/**
 * Handles the creation of table `users`.
 */
class m180121_043528_create_users_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('users', [
            'id' => $this->primaryKey(),
            'nickname' => $this->string()->notNull()->unique(),
            'password' => $this->string(),
            'auth_key' => $this->string()->unique(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('users');
    }
}
