<?php

namespace App\Middleware;

use Core\Http\Middleware\Middleware;
use Core\Http\Request;
use Lib\Authentication\Auth;
use Lib\FlashMessage;

class TattooistAuthenticate implements Middleware
{
    public function handle(Request $request): void
    {
        if (!Auth::check() || !Auth::user()->isTattooist()) {
            FlashMessage::danger('Acesso restrito a tatuadores');
            $this->redirectTo(route('users.login'));
        }
    }

    private function redirectTo(string $location): void
    {
        header('Location: ' . $location);
        exit;
    }
}
