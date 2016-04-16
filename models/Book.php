<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%books}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $author_id
 * @property string $date
 * @property string $preview
 * @property integer $date_create
 * @property integer $date_update
 *
 * @property Author $author
 */
class Book extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%books}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            'createdAtAttribute' => 'date_create',
            'updatedAtAttribute' => 'date_update',
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'author_id', 'date', 'date_create', 'date_update'], 'required'],
            [['author_id', 'date_create', 'date_update'], 'integer'],
            [['date'], 'safe'],
            [['name', 'preview'], 'string', 'max' => 255],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => Author::className(), 'targetAttribute' => ['author_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'author_id' => 'Author ID',
            'date' => 'Date',
            'preview' => 'Preview',
            'date_create' => 'Date Create',
            'date_update' => 'Date Update',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(Author::className(), ['id' => 'author_id']);
    }

    /**
     * @inheritdoc
     * @return query\BooksQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new query\BooksQuery(get_called_class());
    }
}
