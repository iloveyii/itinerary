<?php

use yii\db\Migration;

class m170131_213312_addedTitleToChallenge extends Migration
{
    public function up()
    {
        // $this->addColumn('challenge', 'title', $this->string(100)->notNull() );
    }

    public function down()
    {
        // $this->dropColumn('challenge', 'title');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
