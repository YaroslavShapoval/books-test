<?php
use tests\codeception\_pages\LoginPage;


/**
 * Inherited Methods
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method \Codeception\Lib\Friend haveFriend($name, $actorClass = null)
 *
 * @SuppressWarnings(PHPMD)
*/
class AcceptanceTester extends \Codeception\Actor
{
    use _generated\AcceptanceTesterActions;

    /**
     * Waiting only for selenium
     * @param integer $time
     */
    public function amWaiting($time = 1)
    {
        if (method_exists($this, 'wait')) {
            $this->wait($time);
        }
    }

    public function seeAccessDenied()
    {
        $I = $this;

        $I->amGoingTo('view access denied for guest users');
        $I->expectTo('see login form');
        $I->seeInTitle('Войти');
        $I->seeLink('Войти');
        $I->see('Войти', 'h1');
        $I->see('Войти', 'button');
        $I->see('Логин', 'label');
        $I->see('Пароль', 'label');
        $I->seeCheckboxIsChecked('#loginform-rememberme');
    }

    public function login()
    {
        $I = $this;
        if (method_exists($I, 'loadSessionSnapshot')) if ($I->loadSessionSnapshot('login')) return;

        $I->amGoingTo('login');
        $I->expectTo('login into the site as existing user');
        $page = LoginPage::openBy($this);
        $page->login('demo', 'password_0');
        $this->amWaiting();
        $I->dontSeeLink('Войти');
        $I->see("Выйти (demo)", 'button');
        if (method_exists($I, 'saveSessionSnapshot')) $I->saveSessionSnapshot('login');
    }
}
