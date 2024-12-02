<?php
//
//namespace Database\Populate;
//
//use App\Models\Ratings;
//
//class RatingsPopulate
//{
//  public static function populate()
//  {
//
//    $data = [
//      'rating' => 10,
//      'comment'=> 'comentario '
//    ];
//
//    $rating = new Rating($data);
//    $rating->save();
//
//
//    $numberOfRatings = 10;
//
//    for ($i = 1; $i < $numberOfRatings; $i++) {
//
//      $data = [
//        'rating' => $i,
//        'comment'=> 'comentario ' . $i
//      ];
//
//      $rating = new Rating(rating: $i);
//      $rating->save;
//    }
//    echo "Ratings populated with $numberOfRatings registers\n";
//  }
//}
