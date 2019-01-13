<?php

use yii\db\Migration;

class m180209_201537_create_table_connections extends Migration
{
    public function up()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('connection', [
            'id' => $this->primaryKey(),
            'from_vertex_id' => $this->integer()->notNull(),
            'to_vertex_id' => $this->integer()->notNull(),
            'updated_at' => $this->timestamp()->defaultValue(null),
            'created_at' => $this->timestamp()->defaultValue(null),
        ], $tableOptions);

        // creates index for column `from_vertex_id`
        $this->createIndex(
            'idx-from-vertex_id',
            'connection',
            'from_vertex_id'
        );

        // creates index for column `to_vertex_id`
        $this->createIndex(
            'idx-to-vertex_id',
            'connection',
            'to_vertex_id'
        );

        // add foreign key for table `vertex`
        $this->addForeignKey(
            'fk-from-vertex-vertex_id',
            'connection',
            'from_vertex_id',
            'vertex',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-to-vertex-vertex_id',
            'connection',
            'to_vertex_id',
            'vertex',
            'id',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropTable('connection');
    }
}
