<?php

use yii\db\Migration;

class m170127_202836_create_table_category extends Migration
{
    public function up()
    {
        return true;
        $this->createTable('category', [
            'id' => $this->primaryKey(),
            'name' => $this->string(65)->notNull(),
        ]);
    }

    public function down()
    {
        return true;
        $this->dropTable('category');
    }
}
