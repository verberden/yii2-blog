<?php

use yii\db\Migration;

/**
 * Handles the creation of table `posts`.
 */
class m180121_043541_create_posts_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('posts', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'title' => $this->string(),
            'body' => $this->text(),
        ]);

        $this->createIndex(
            'idx-posts-user_id',
            'posts',
            'user_id'
        );

        $this->addForeignKey(
            'fk-posts-user_id',
            'posts',
            'user_id',
            'users',
            'id',
            'CASCADE'
        );
    }



    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey(
            'fk-posts-user_id',
            'posts'
        );

        $this->dropIndex(
            'idx-posts-user_id',
            'posts'
        );

        $this->dropTable('posts');
    }
}
