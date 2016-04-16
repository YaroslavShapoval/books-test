<?php

namespace app\models\query;
use app\models\Author;
use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[Author]].
 *
 * @see Author
 */
class AuthorsQuery extends ActiveQuery
{
    /**
     * @inheritdoc
     * @return Author[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Author|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
