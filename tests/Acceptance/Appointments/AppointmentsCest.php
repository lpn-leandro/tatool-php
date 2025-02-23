<?php

namespace Tests\Acceptance\Appointmentss;

use App\Models\Appointment;
use App\Models\User;
use Tests\Acceptance\BaseAcceptanceCest;
use Tests\Support\AcceptanceTester;

class AppointmentsCest extends BaseAcceptanceCest
{
    public function seeMyAppointmentss(AcceptanceTester $page): void
    {
        $tattoist = new User([
            'name' => 'Tatuador 1',
            'email' => 'tatuador@example.com',
            'password' => '123456',
            'password_confirmation' => '123456',
            'user_type' => 'T'
        ]);
        $tattoist->save();

        $user = new User([
            'name' => 'Usuario 1',
            'email' => 'usuario@example.com',
            'password' => '123456',
            'password_confirmation' => '123456',
            'user_type' => 'U'
        ]);
        $user->save();

        $appointment = new Appointment([
            'date' => '2025-12-31 10:00:00',
            'size' => 'medio',
            'location' => 'barriga',
            'status' => 'pendente',
            'users_id' => $user->id,
            'tattooists_id' => $tattoist->id]);
        $appointment->save();

        $page->login($tattoist->email, $tattoist->password);

        $page->amOnPage('tattooist/appointments');

        $tableSelector = 'table';

        $page->see('#1', '//table//tr[1]//td[1]');
        $page->see('2025-12-31 10:00:00', '//table//tr[1]//td[2]');
    }
}
