<?php

namespace Database\Populate;

use App\Models\Studio;

class StudiosPopulate
{
   public static function populate()
   {

       $numberOfStudios = 10;

       for ($i = 1; $i < $numberOfStudios; $i++) {

           $data = [
               'name' => 'Estudio ' . $i,
               'address'=> 'Rua dos Bobos, ' . $i,
           ];

           $studio = new Studio($data);
           $studio->save();
       }
       echo "Studios populated with $numberOfStudios registers\n";
   }
}