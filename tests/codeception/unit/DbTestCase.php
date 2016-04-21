<?php

namespace tests\codeception\unit;

use tests\codeception\fixtures\AuthorFixture;
use tests\codeception\fixtures\UserFixture;

class DbTestCase extends \yii\codeception\DbTestCase
{
    public function fixtures()
    {
        return [
            AuthorFixture::className(),
        ];
    }

    public function globalFixtures()
    {
        return [
            UserFixture::className(),
        ];
    }
}