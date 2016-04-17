<?php

use tests\codeception\_pages\LoginPage;

/* @var $scenario Codeception\Scenario */

$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that login works');

$loginPage = LoginPage::openBy($I);

$I->seeAccessDenied();

$I->amGoingTo('try to login with empty credentials');
$loginPage->login('', '');
$I->amWaiting();
$I->expectTo('see validations errors');
$I->see('Введите логин пользователя');
$I->see('Введите пароль');

$I->amGoingTo('try to login with wrong credentials');
$loginPage->login('admin', 'wrong');
$I->amWaiting();
$I->expectTo('see validations errors');
$I->see('Неверный логин или пароль');

$I->login();
