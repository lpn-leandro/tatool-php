<?php

namespace Database\Populate;

use App\Models\User;

class UsersPopulate
{
  public static function populate()
  {
    $data = [
      'name' => 'Usuário',
      'email' => 'usuario@example.com',
      'password' => '123456',
      'password_confirmation' => '123456',
      'bio' => 'Descrição de exemplo',
      'rate_id' => 1,
      'user_type' => 'U'
    ];

    $user = new User($data);
    $user->save();

    $numberOfUsers = 10;

    for ($i = 1; $i < $numberOfUsers; $i++) {
      $data = [
        'name' => 'Usuário' . $i,
        'email' => 'usuario' . $i . '@example.com',
        'password' => '123456',
        'password_confirmation' => '123456',
        'bio' => 'Tatuador de exemplo',
        'rate_id' => 1,
        'user_type' => 'U'
      ];

      $user = new User($data);
      $user->save();
    }
    echo "Users populated with $numberOfUsers registers\n";
  }
}
