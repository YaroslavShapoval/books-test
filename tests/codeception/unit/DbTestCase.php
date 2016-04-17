<?php

namespace tests\codeception\unit;

use tests\codeception\fixtures\UserFixture;

class DbTestCase extends \yii\codeception\DbTestCase
{
    public function fixtures()
    {
        return [];
    }

    public function globalFixtures()
    {
        return [
            UserFixture::className(),
        ];
    }
}