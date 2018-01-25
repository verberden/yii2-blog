<?php

use yii\db\Migration;

/**
 * Class m180125_053201_add_cat_to_posts
 */
class m180125_053201_add_cat_to_posts extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn('posts', 'category','string');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropColumn('posts', 'category');

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180125_053201_add_cat_to_posts cannot be reverted.\n";

        return false;
    }
    */
}
