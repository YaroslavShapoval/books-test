<?php

use yii\db\Migration;

class m160416_113100_add_user extends Migration
{
    private $tableName = '{{%users}}';

    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->insert($this->tableName, [
            'username' => 'admin',
            'auth_key' => Yii::$app->security->generateRandomString(),
            // password = 123
            'password_hash' => Yii::$app->security->generatePasswordHash('123'),
            'password_reset_token' => Yii::$app->security->generateRandomString() . '_' . time(),
            'created_at' => time(),
            'updated_at' => time(),
            'email' => 'shapoval.yaroslav@gmail.com',
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->truncateTable($this->tableName);
    }
}
