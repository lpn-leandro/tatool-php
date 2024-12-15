<?php

namespace App\Middleware;

use Core\Http\Middleware\Middleware;
use Core\Http\Request;
use Lib\Authentication\Auth;
use Lib\FlashMessage;

class UserAuthenticate implements Middleware
{
    public function handle(Request $request): void
    {
        if (!Auth::check() || !Auth::user()->isUser()) {
            FlashMessage::danger('Acesso restrito a Usuários');
            $this->redirectTo(route('users.login'));
        }
    }

    private function redirectTo(string $location): void
    {
        header('Location: ' . $location);
        exit;
    }
}
