<?php

namespace Tests\Unit\Controllers;

use App\Models\User;

class TattooistProfileControllerTest extends ControllerTestCase
{
    private User $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = new User([
            'name' => 'Tatuador 1',
            'email' => 'tatuador@example.com',
            'password' => '123456',
            'password_confirmation' => '123456',
            'user_type' => 'T',
        ]);
        $this->user->save();
        $_SESSION['user']['id'] = $this->user->id;
    }

    public function test_show_current_user_profile(): void
    {
        $response = $this->get(action: 'show', controllerName: 'App\Controllers\Tattooists\ProfileController');

        $this->assertMatchesRegularExpression("/{$this->user->name}/", $response);
        $this->assertMatchesRegularExpression("/{$this->user->email}/", $response);
    }
}