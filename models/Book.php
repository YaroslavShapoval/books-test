<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\StringHelper;

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
 * @property string $previewUrl
 * @property Author $author
 */
class Book extends ActiveRecord
{
    /**
     * @var \yii\web\UploadedFile
     */
    public $previewFile = null;

    /**
     * @inheritdoc
     * @codeCoverageIgnore
     */
    public static function tableName()
    {
        return '{{%books}}';
    }

    /**
     * @inheritdoc
     * @codeCoverageIgnore
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'date_create',
                'updatedAtAttribute' => 'date_update',
            ],
        ];
    }

    /**
     * @inheritdoc
     * @codeCoverageIgnore
     */
    public function rules()
    {
        return [
            [['name', 'author_id', 'date'], 'required'],
            [['author_id', 'date_create', 'date_update'], 'integer'],
            [['date'], 'date', 'format' => 'yyyy-mm-dd'],
            [['name', 'preview'], 'string', 'max' => 255],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => Author::className(), 'targetAttribute' => ['author_id' => 'id']],
            [['previewFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg'],
        ];
    }

    /**
     * @inheritdoc
     * @codeCoverageIgnore
     */
    public function beforeSave($insert)
    {
        if (!$this->validate()) {
            return false;
        }

        $this->upload();

        return parent::beforeSave($insert);
    }

    /**
     * @inheritdoc
     * @codeCoverageIgnore
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID книги',
            'name' => 'Название',
            'author_id' => 'Автор',
            'date' => 'Дата выхода книги',
            'preview' => 'Превью',
            'previewFile' => 'Превью',
            'date_create' => 'Date Create',
            'date_update' => 'Date Update',
        ];
    }

    /**
     * Save uploaded image
     */
    private function upload()
    {
        if (!empty($this->previewFile)) {
            $fileName = StringHelper::truncate($this->previewFile->baseName, 100) . '_' . time() . '.' . $this->previewFile->extension;
            $this->previewFile->saveAs(Yii::$app->params['uploadFolder'] . $fileName);
            $this->preview = $fileName;
        }
    }

    /**
     * @return null|string
     */
    public function getPreviewUrl()
    {
        if (!empty($this->preview)) {
            return Yii::$app->params['uploadUrl'] . $this->preview;
        }

        return null;
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
