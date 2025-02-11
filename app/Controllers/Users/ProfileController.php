<?php

namespace App\Controllers\Users;

use Core\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function show(): void
    {
        $title = 'Meu Perfil';
        $this->render('users/profile/show', compact('title'));
    }

    public function updateAvatar(): void
    {
        $image = $_FILES['user_avatar'];

        $this->current_user->avatar()->update($image);
        $this->redirectTo(route('user.profile.show'));
    }
}