<?php

use tests\codeception\_pages\LoginPage;

/* @var $scenario Codeception\Scenario */

$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that login works');

$loginPage = LoginPage::openBy($I);

$I->see('Login', 'h1');

$I->amGoingTo('try to login with empty credentials');
$loginPage->login('', '');
$I->amWaiting(1);
$I->expectTo('see validations errors');
$I->see('Username cannot be blank.');
$I->see('Password cannot be blank.');

$I->amGoingTo('try to login with wrong credentials');
$loginPage->login('admin', 'wrong');
$I->amWaiting(1);
$I->expectTo('see validations errors');
$I->see('Incorrect username or password.');

$I->amGoingTo('try to login with correct credentials');
$loginPage->login('amanda48', 'password_0');
$I->amWaiting(1);
$I->expectTo('see user info');
$I->see('Logout (amanda48)');
