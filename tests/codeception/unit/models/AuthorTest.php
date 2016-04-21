<?php

namespace tests\codeception\unit\models;

use app\models\Author;
use tests\codeception\fixtures\AuthorFixture;
use tests\codeception\unit\DbTestCase;
use Codeception\Specify;

class AuthorTest extends DbTestCase
{
    use Specify;

    /**
     * @var \UnitTester
     */
    protected $tester;

    public function fixtures()
    {
        return [
            'authors' => AuthorFixture::className(),
        ];
    }

    public function testValidationsRules()
    {

    }

    public function testSearch()
    {
        $I = $this->tester;

        $I->wantToTest("authors search");
        $I->expectTo("");

        $this->specify("should be possible to find data about all authors", function() {
            expect("in databse should be exact authors count", Author::find()->count())->equals(10);
        });

        $this->specify("should not be possible to find data about non-existing author", function() {
            expect_not("should not found non-existing author", Author::find()->andWhere([
                'firstname' => 'non_existing_author_firstname',
                'lastname' => 'non_existing_author_lastname',
            ])->exists());
        });

        $this->specify("should be possible to find data about each author", function() {
            $data = [
                'firstname' => 'Willis',
                'lastname' => 'Quigley',
            ];

            expect_that("should found existing author", Author::find()->andWhere($data)->exists());
            expect("found author should be alone", Author::find()->andWhere($data)->count())->equals(1);

            $authorModel = Author::find()->andWhere($data)->one();

            expect("author's firstname should be the same that in search request", $authorModel->firstname)->equals('Willis');
            expect("author's lastname should be the same that in search request", $authorModel->lastname)->equals('Quigley');
        });
    }

    public function testFullName()
    {

    }
}