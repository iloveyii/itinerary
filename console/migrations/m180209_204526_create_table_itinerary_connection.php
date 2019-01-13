<?php

use yii\db\Migration;

class m180209_204526_create_table_itinerary_connection extends Migration
{
    public function up()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('itinerary_connection', [
            'id' => $this->primaryKey(),
            'itinerary_id' => $this->integer()->notNull(),
            'connection_id' => $this->integer()->notNull(),
            'updated_at' => $this->timestamp()->defaultValue(null),
            'created_at' => $this->timestamp()->defaultValue(null),
        ], $tableOptions);

        // creates index for column `itinerary_id`
        $this->createIndex(
            'idx-itinerary_id',
            'itinerary_connection',
            'itinerary_id'
        );

        // creates index for column `connection_id`
        $this->createIndex(
            'idx-connection_id',
            'itinerary_connection',
            'connection_id'
        );

        // add foreign key for table `itinerary`
        $this->addForeignKey(
            'fk-itinerary_id',
            'itinerary_connection',
            'itinerary_id',
            'itinerary',
            'id',
            'CASCADE'
        );
        // add foreign key for table `connection`
        $this->addForeignKey(
            'fk-connection_id',
            'itinerary_connection',
            'connection_id',
            'connection',
            'id',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropTable('itinerary_connection');
    }
}
