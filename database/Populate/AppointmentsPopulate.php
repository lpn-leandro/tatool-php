<?php

namespace Database\Populate;

use App\Models\Appointment;
use App\Models\User;
use App\Models\Tattoists;

class AppointmentsPopulate
{
    public static function populate()
    {
        $user = User::findBy(['email' => 'usuario@example.com']);
        $tattoist = User::findBy(['email' => 'tatuador@example.com']);

        $numberOfAppointments = 10;

        for ($i = 0; $i < $numberOfAppointments; $i++) {
            $problem = new Appointment(['date' => '2025-12-31 10:00:00', 'size' => 'P', 'image_url' => 'https://example.com/image.jpg', 'location' => 'Braço', 'status' => 'Pendente', 'user_id' => $user->id, 'tattoist_id' => $tattoist->id]);
            $problem->save();
        }

        echo "Appointments populated with $numberOfAppointments registers\n";
    }
}