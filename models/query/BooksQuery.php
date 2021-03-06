<?php

namespace app\models\query;
use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[\app\models\Book]].
 *
 * @see \app\models\Book
 */
class BooksQuery extends ActiveQuery
{
    /**
     * @inheritdoc
     * @return \app\models\Book[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\Book|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
