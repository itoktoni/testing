<?php

class LoginFormCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amOnRoute('/login');
    }

    public function openLoginPage(\FunctionalTester $I)
    {
        // $I->see('Login');
    }

    // demonstrates `amLoggedInAs` method
    public function internalLoginById(\FunctionalTester $I)
    {
        // $I->amLoggedInAs(100);
        // $I->amOnPage('/');
        // $I->see('Logout (admin)');
    }

    // demonstrates `amLoggedInAs` method
    public function internalLoginByInstance(\FunctionalTester $I)
    {
        // $I->amLoggedInAs(\app\models\User::findByUsername('admin'));
        // $I->amOnPage('/');
        // $I->see('Logout (admin)');
    }

    public function loginWithEmptyCredentials(\FunctionalTester $I)
    {
        // $I->submitForm('#login-form', []);
        // $I->expectTo('see validations errors');
        // $I->see('Username cannot be blank.');
        // $I->see('Password cannot be blank.');
    }

    public function loginWithWrongCredentials(\FunctionalTester $I)
    {
        // $I->submitForm('#login-form', [
        //     'Users[email]' => 'itok.toni@gmail.com',
        //     'Users[password]' => '123',
        // ]);
        // $I->expectTo('see validations errors');
        // $I->see('Incorrect username or password.');
    }

    public function loginSuccessfully(\FunctionalTester $I)
    {
        // $I->submitForm('#login-form', [
        //     'Users[email]' => 'itok.toni@gmail.com',
        //     'Users[password]' => '123',
        // ]);
        // $I->see('Logout (admin)');
        // $I->dontSeeElement('form#login-form');              
    }
}