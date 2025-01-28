<?php

namespace App\Controllers;

use App\Models\User;
use Core\Http\Controllers\Controller;
use Core\Http\Request;
use Lib\Authentication\Auth;
use Lib\FlashMessage;

class AuthenticationsController extends Controller
{
    protected string $layout = 'login';

    public function new(): void
    {
        $this->render('authentications/new');
    }

    public function authenticate(Request $request): void
    {
        $params = $request->getParam('user');
        $user = User::findByEmail($params['email']);

        if ($user && $user->authenticate($params['password'])) {
            Auth::login($user);

            if ($user->user_type === 'T') {
                FlashMessage::success('Login realizado com sucesso!');
                $this->redirectTo(route('tattooists.home'));
            } elseif ($user->user_type === 'U') {
                FlashMessage::success('Login realizado com sucesso!');
                $this->redirectTo(route('home.userIndex'));
            }
        } else {
            FlashMessage::danger('E-mail e/ou senha inválidos!');
            $this->redirectTo(route('users.login'));
        }
    }

    public function destroy(): void
    {
        Auth::logout();
        FlashMessage::success('Logout realizado com sucesso!');
        $this->redirectTo(route('users.login'));
    }
}
