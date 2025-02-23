<?php

namespace Tests\Acceptance\Authentication;

use App\Models\User;
use Tests\Acceptance\BaseAcceptanceCest;
use Tests\Support\AcceptanceTester;

class LoginCest extends BaseAcceptanceCest
{
    public function loginSuccessfully(AcceptanceTester $page): void
    {
        $user = new User([
            'name' => 'Tatuador 1',
            'email' => 'tatuador@example.com',
            'password' => '123456',
            'password_confirmation' => '123456',
            'user_type' => 'T'
        ]);
        $user->save();

        $page->amOnPage('/login');

        $page->fillField('user[email]', $user->email);
        $page->fillField('user[password]', $user->password);

        $page->click('Entrar');

        $page->see('Login realizado com sucesso!');
        $page->seeInCurrentUrl('/tattooist');
    }

    public function loginUnsuccessfully(AcceptanceTester $page): void
    {
        $page->amOnPage('/login');

        $page->fillField('user[email]', 'tatuador@example.com');
        $page->fillField('user[password]', 'wrong_password');

        $page->click('Entrar');

        $page->see('E-mail e/ou senha inválidos!');
        $page->seeInCurrentUrl('/login');
    }
}