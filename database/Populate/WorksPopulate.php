<?php
//
//namespace Database\Populate;
//
//use App\Models\Works;
//
//class WorksPopulate
//{
//  public static function populate()
//  {
//
//    $data = [
//      'image_url' => 'https://www.google.com',
//      'description'=> 'descrição'
//    ];
//
//    $work = new Work($data);
//    $work->save();
//
//
//    $numberOfWorks = 10;
//
//    for ($i = 1; $i < $numberOfWorks; $i++) {
//
//      $data = [
//        'image_url' => 'https://www.google.com',
//        'description'=> 'descrição'
//      ];
//
//      $work = new Work(image_url: 'Work' . $i);
//      $work->save;
//    }
//    echo "Works populated with $numberOfWorks registers\n";
//  }
//}
