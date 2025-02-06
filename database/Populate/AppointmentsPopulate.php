<?php

namespace Database\Populate;

use App\Models\Appointment;
use App\Models\User;

class AppointmentsPopulate
{
   public static function populate()
   {
       $user = User::findBy(['email' => 'usuario1@example.com']);
       $tattoist = User::findBy(['email' => 'tatuador@example.com']);

       $numberOfAppointments = 10;

       for ($i = 0; $i < $numberOfAppointments; $i++) {
           $appointment = new Appointment(['date' => '2025-12-31 10:00:00', 'size' => 'medio',  'location' => 'barriga', 'status' => 'pendente', 'users_id' => $user->id, 'tattooists_id' => $tattoist->id]);
           $appointment->save();
       }

       echo "Appointments populated with $numberOfAppointments registers\n";
   }
}
