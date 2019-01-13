<?php

use yii\db\Migration;

class m170214_145639_import_db_data extends Migration
{
    private $username = 'root';
    private $password = 'root';

    public function up()
    {
        return true;
        $path = sprintf("%s/%s/%s", Yii::getAlias('@app'), 'migrations','challenge20170214.sql');

        if(! file_exists($path)) {
            return false;
        } else {
            echo 'Importing data from: ' . $path . PHP_EOL;
        }

        echo 'Database user name and password must be set inside this script: ' . __FILE__ . PHP_EOL;
        $cmd = sprintf("mysql -u%s -p%s --database=challenge < %s", $this->username, $this->password, $path);
        exec($cmd);
    }
}
