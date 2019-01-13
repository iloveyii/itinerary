<?php

use yii\db\Migration;

class m180215_083423_add_col_distance_to_connection extends Migration
{
    public function up()
    {
        $this->addColumn('connection', 'distance', $this->integer()->null() );
    }

    public function down()
    {
        $this->dropColumn('connection', 'distance');
    }
}
