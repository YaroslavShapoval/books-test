<?php

use yii\db\Migration;

class m160416_113911_fill_authors_table_with_test_data extends Migration
{
    private $tableName = '{{%authors}}';

    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->insert($this->tableName, [
            'firstname' => 'Cornelius',
            'lastname' => 'Anisimov',
        ]);

        $this->insert($this->tableName, [
            'firstname' => 'Mikaela',
            'lastname' => 'Linna',
        ]);

        $this->insert($this->tableName, [
            'firstname' => 'Arseny',
            'lastname' => 'Kharlamov',
        ]);

        $this->insert($this->tableName, [
            'firstname' => 'Ostap',
            'lastname' => 'Pirogov',
        ]);

        $this->insert($this->tableName, [
            'firstname' => 'Vyacheslav',
            'lastname' => 'Kozlov',
        ]);

        $this->insert($this->tableName, [
            'firstname' => 'Murat',
            'lastname' => 'Nekrasov',
        ]);

        $this->insert($this->tableName, [
            'firstname' => 'Anna',
            'lastname' => 'Artamonova',
        ]);

        $this->insert($this->tableName, [
            'firstname' => 'Rashid',
            'lastname' => 'Kotov',
        ]);

        $this->insert($this->tableName, [
            'firstname' => 'Regina',
            'lastname' => 'Glebova',
        ]);

        $this->insert($this->tableName, [
            'firstname' => 'Nick',
            'lastname' => 'Zotov',
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
