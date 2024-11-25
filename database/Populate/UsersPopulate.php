<?php

namespace Database\Populate;

use App\Models\User;

class UsersPopulate
{
    public static function populate()
    {

        $data = [
            'name' => 'Usuário',
            'email'=> 'usuario@example.com',
            'password'=> '123456',
            'password_confirmation'=> '123456'
        ];

        $user = new User($data);
        $user->save();


        $numberOfUsers = 10;
        
        for ($i = 1; $i < $numberOfUsers; $i++) {

            $data = [
                'name' => 'Usuário' . $i,
                'email'=> 'usuario' . $i . '@example.com',
                'password'=> '123456',
                'password_confirmation'=> '123456'
            ];

            $user = new User(name: 'User' . $i);
            $user->save;
        }
        echo "Users populated with $numberOfUsers registers\n";
    }
}