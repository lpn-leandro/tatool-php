<?php
//
//namespace Database\Populate;
//
//use App\Models\Studios;
//
//class StudiosPopulate
//{
//    public static function populate()
//    {
//
//        $data = [
//            'name' => 'Estudio A',
//            'address'=> 'Rua dos Bobos, 0',
//            'users_id'=> 1
//        ];
//
//        $studio = new Studio($data);
//        $studio->save();
//
//
//        $numberOfStudios = 10;
//
//        for ($i = 1; $i < $numberOfStudios; $i++) {
//
//            $data = [
//                'name' => 'Estudio ' . $i,
//                'addres'=> 'Rua dos Bobos, ' . $i,
//                'users_id' => 1,
//            ];
//
//            $studio = new Studio(name: 'Studio' . $i);
//            $studio->save;
//        }
//        echo "Studios populated with $numberOfStudios registers\n";
//    }
//}
