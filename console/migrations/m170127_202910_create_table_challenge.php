<?php

use yii\db\Migration;

class m170127_202910_create_table_challenge extends Migration
{
    public function up()
    {
        return true;
        $this->createTable('challenge', [
            'id' => $this->primaryKey(),
            'sub_category_id' => $this->string(45)->notNull(),
            'date_start' => $this->timestamp()->defaultValue(null),
            'date_stop' => $this->timestamp()->defaultValue(null),
            'description' => $this->string(200),
            'expected_result' => $this->string(50),
        ]);
    }

    public function down()
    {
        return true;
        $this->dropTable('challenge');
    }
}
