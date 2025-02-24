<?php

namespace Tests\Unit\Controllers\User;

use App\Models\Appointment;
use App\Models\User;
use Tests\Unit\Controllers\ControllerTestCase;

class UserAppointmentsControllerTest extends ControllerTestCase
{
    private User $user;
    private User $tattooist;

    public function setUp(): void
    {
        parent::setUp();
        $this->tattooist = new User([
            'name' => 'Tatuador 1',
            'email' => 'tatuador@example.com',
            'password' => '123456',
            'password_confirmation' => '123456',
            'user_type' => 'T'
        ]);
        $this->tattooist->save();
        $this->user = new User([
            'name' => 'Usuario 1',
            'email' => 'usuario@example.com',
            'password' => '123456',
            'password_confirmation' => '123456',
            'user_type' => 'U'
        ]);
        $this->user->save();
        $_SESSION['user']['id'] = $this->user->id;
    }

    public function test_list_all_appointments(): void
    {
        $appointments[] = new Appointment([
            'date' => '2025-12-31 10:00:00',
            'size' => 'medio',
            'location' => 'barriga',
            'status' => 'pendente',
            'users_id' => $this->user->id,
            'tattooists_id' => $this->tattooist->id
        ]);
        $appointments[] = new Appointment([
            'date' => '2025-12-30 10:00:00',
            'size' => 'medio',
            'location' => 'barriga',
            'status' => 'pendente',
            'users_id' => $this->user->id,
            'tattooists_id' => $this->tattooist->id
        ]);

        foreach ($appointments as $appointment) {
            $appointment->save();
        }

        $response = $this->get(action: 'index', controllerName: 'App\Controllers\Users\AppointmentsController');

        foreach ($appointments as $appointment) {
            $this->assertMatchesRegularExpression("/{$appointment->tattooist->name}/", $response);
        }
    }

    public function test_show_appointment(): void
    {
        $appointment = new Appointment([
            'date' => '2025-12-31 10:00:00',
            'size' => 'medio',
            'location' => 'barriga',
            'status' => 'pendente',
            'users_id' => $this->user->id,
            'tattooists_id' => $this->tattooist->id
        ]);
        $appointment->save();

        $response = $this->get(
            action: 'show',
            controllerName: 'App\Controllers\Users\AppointmentsController',
            params: ['id' => $appointment->id]
        );

        $this->assertMatchesRegularExpression("/Visualização do Agendamento #{$appointment->id}/", $response);
        $this->assertMatchesRegularExpression("/{$appointment->tattooist->name}/", $response);
    }

    public function test_successfully_create_appointment(): void
    {
        $params = ['appointment' => [
            'date' => '2025-12-31 10:00:00',
            'size' => 'medio',
            'location' => 'barriga',
            'status' => 'pendente',
            'users_id' => $this->user->id,
            'tattooists_id' => $this->tattooist->id
        ]];

        $response = $this->post(
            action: 'create',
            controllerName: 'App\Controllers\Users\AppointmentsController',
            params: $params
        );

        $this->assertMatchesRegularExpression("/Location: \/users\/appointments/", $response);
    }

    public function test_unsuccessfully_create_appointment(): void
    {
        $params = ['appointment' => [
            'date' => '',
            'size' => 'medio',
            'location' => 'barriga',
            'status' => 'pendente',
            'users_id' => $this->user->id,
            'tattooists_id' => $this->tattooist->id
        ]];

        $response = $this->post(
            action: 'create',
            controllerName: 'App\Controllers\Users\AppointmentsController',
            params: $params
        );

        $this->assertMatchesRegularExpression("/não pode ser vazio!/", $response);
    }

    public function test_edit_appointment(): void
    {
        $appointment = new Appointment([
            'date' => '2025-12-31 10:00:00',
            'size' => 'medio',
            'location' => 'barriga',
            'status' => 'pendente',
            'users_id' => $this->user->id,
            'tattooists_id' => $this->tattooist->id
        ]);
        $appointment->save();

        $response = $this->get(
            action: 'edit',
            controllerName: 'App\Controllers\Users\AppointmentsController',
            params: ['id' => $appointment->id]
        );

        $this->assertMatchesRegularExpression("/Editar Agendamento #{$appointment->id}/", $response);

        $regex = '/<option\s[^>]*value=[\'"]barriga[\'"][^>]*selected[^>]*>/i';

        $this->assertMatchesRegularExpression($regex, $response);
    }


    public function test_successfully_update_appointment(): void
    {
        $appointment = new Appointment([
            'date' => '2025-12-31 10:00:00',
            'size' => 'medio',
            'location' => 'barriga',
            'status' => 'pendente',
            'users_id' => $this->user->id,
            'tattooists_id' => $this->tattooist->id
        ]);
        $appointment->save();
        $params = ['id' => $appointment->id, 'appointment' => [
            'date' => '2025-12-31 10:00:00',
            'size' => 'medio',
            'location' => 'braco',
            'status' => 'pendente',
            'users_id' => $this->user->id,
            'tattooists_id' => $this->tattooist->id
        ]];

        $response = $this->put(
            action: 'update',
            controllerName: 'App\Controllers\Users\AppointmentsController',
            params: $params
        );

        $this->assertMatchesRegularExpression("/Location: \/users\/appointments/", $response);
    }

    public function test_unsuccessfully_update_appointment(): void
    {
        $appointment = new Appointment([
            'date' => '2025-12-31 10:00:00',
            'size' => 'medio',
            'location' => 'barriga',
            'status' => 'pendente',
            'users_id' => $this->user->id,
            'tattooists_id' => $this->tattooist->id
        ]);
        $appointment->save();

        $params = ['id' => $appointment->id, 'appointment' => [
            'date' => '2025-12-31 10:00:00',
            'size' => 'medio',
            'location' => '',
            'status' => 'pendente',
            'users_id' => $this->user->id,
            'tattooists_id' => $this->tattooist->id
        ]];

        $response = $this->put(
            action: 'update',
            controllerName: 'App\Controllers\Users\AppointmentsController',
            params: $params
        );

        $this->assertMatchesRegularExpression("/não pode ser vazio!/", $response);
    }
}
