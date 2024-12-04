<?php

namespace Database\Populate;

use App\Models\User;

class UsersPopulate
{
  public static function populate()
  {
    $data = [
      'name' => 'tatuador',
      'email' => 'tatuador@example.com',
      'password' => '123456',
      'password_confirmation' => '123456',
      'bio' => 'tatuador',
      'rate_id' => 1,
      'user_type' => 'T',
    ];

    $user = new User($data);
    $user->save();

    $numberOfUsers = 10;

    for ($i = 1; $i < $numberOfUsers; $i++) {
      $data = [
        'name' => 'usuario' . $i,
        'email' => 'usuario' . $i . '@example.com',
        'password' => '123456',
        'password_confirmation' => '123456',
        'user_type' => 'U',
      ];

      $user = new User($data);
      $user->save();
    }
    echo "Users populated with $numberOfUsers registers\n";
  }
}
