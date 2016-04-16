<?php

use yii\db\Migration;

class m160416_115815_create_books extends Migration
{
    private $tableName = '{{%books}}';

    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'author_id' => $this->integer()->notNull(),
            'date' => $this->datetime()->notNull(),
            'preview' => $this->string(),
            'date_create' => $this->integer()->notNull(),
            'date_update' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey(
            'fk_book_author_id',
            $this->tableName,
            'author_id',
            \app\models\Author::tableName(),
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable($this->tableName);
    }
}
