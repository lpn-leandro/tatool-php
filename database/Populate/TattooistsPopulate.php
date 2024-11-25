<?php

namespace Database\Populate;

use App\Models\Tattooist;

class TattooistsPopulate
{
    public static function populate()
    {

        $data = [
            'name' => 'Tatuador',
            'email'=> 'tatuador@example.com',
            'password'=> '123456',
            'password_confirmation'=> '123456',
            'bio'=> 'Tatuador de exemplo',
            'rate_id' => 1
        ];

        $user = new Tattooist($data);
        $user->save();


        $numberOfTattooists = 10;
        
        for ($i = 1; $i < $numberOfTattooists; $i++) {

            $data = [
                'name' => 'Tatuador' . $i,
                'email'=> 'tatuador' . $i . '@example.com',
                'password'=> '123456',
                'password_confirmation'=> '123456',
                'bio'=> 'Tatuador de exemplo',
                'rate_id' => 1
            ];

            $user = new Tattooist(name: 'Tattooist' . $i);
            $user->save;
        }
        echo "Tattooists populated with $numberOfTattooists registers\n";
    }
}