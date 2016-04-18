<?php

namespace tests\codeception\unit\models;

use app\models\User;
use tests\codeception\fixtures\UserFixture;
use Yii;
use yii\codeception\TestCase;
use app\models\forms\LoginForm;
use Codeception\Specify;

class LoginFormTest extends TestCase
{
    use Specify;

    public function fixtures()
    {
        return [
            'users' => UserFixture::className(),
        ];
    }

    protected function tearDown()
    {
        Yii::$app->user->logout();
        parent::tearDown();
    }

    public function testLoginNoUser()
    {
        $model = new LoginForm([
            'username' => 'not_existing_username',
            'password' => 'not_existing_password',
        ]);

        $this->specify('user should not be able to login, when there is no identity', function () use ($model) {
            expect('model should not login user', $model->login())->false();
            expect('user should not be logged in', Yii::$app->user->isGuest)->true();
        });
    }

    public function testLoginWrongPassword()
    {
        $model = new LoginForm([
            'username' => 'demo',
            'password' => 'wrong_password',
        ]);

        $this->specify('user should not be able to login with wrong password', function () use ($model) {
            expect('model should not login user', $model->login())->false();
            expect('error message should be set', $model->errors)->hasKey('password');
            expect('user should not be logged in', Yii::$app->user->isGuest)->true();
        });
    }

    public function testLoginCorrect()
    {
        $model = new LoginForm([
            'username' => 'demo',
            'password' => 'password_0',
        ]);

        $this->specify('user should be able to login with correct credentials', function () use ($model) {
            expect('model should login user', $model->login())->true();
            expect('error message should not be set', $model->errors)->hasntKey('password');
            expect('user should be logged in', Yii::$app->user->isGuest)->false();
        });
    }

    public function testLoginAsDeletedUser()
    {
        $model = new LoginForm([
            'username' => 'zmeller',
            'password' => 'password_1',
        ]);

        $this->specify('deleted user should not be able to login', function () use ($model) {
            expect('model should not login user', $model->login())->false();
            expect('user should not be logged in', Yii::$app->user->isGuest)->true();
        });
    }

    public function testLoginAfterChangingPassword()
    {
        $user = User::findByUsername('demo');

        $user->setPassword('new_password');
        expect_that($user->save(true, ['password_hash']));

        $model = new LoginForm([
            'username' => 'demo',
            'password' => 'password_0',
        ]);

        $this->specify('existing user should not be able to login with old password', function () use ($model) {
            expect('model should not login user', $model->login())->false();
            expect('error message should be set', $model->errors)->hasKey('password');
            expect('user should not be logged in', Yii::$app->user->isGuest)->true();
        });

        $model = new LoginForm([
            'username' => 'demo',
            'password' => 'new_password',
        ]);

        $this->specify('existing user should be able to login with correct new password', function () use ($model) {
            expect('model should login user', $model->login())->true();
            expect('error message should not be set', $model->errors)->hasntKey('password');
            expect('user should be logged in', Yii::$app->user->isGuest)->false();
        });
    }
}
