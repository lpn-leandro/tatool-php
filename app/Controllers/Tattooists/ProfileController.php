<?php

namespace App\Controllers\Tattooists;

use Core\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function show(): void
    {
        $title = 'Meu Perfil';
        $this->render('/tattooists/profile/show', compact('title'));
    }

    public function updateAvatar(): void
    {
        $image = $_FILES['user_avatar'];

        $this->current_user->avatar()->update($image);
        $this->redirectTo(route('tattooist.profile.show'));
    }
}
