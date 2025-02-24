<?php

namespace Tests\Unit\Models\Appointments;

use App\Models\Appointment;
use App\Models\User;
use Tests\TestCase;

class AppointmentTest extends TestCase
{
    private Appointment $appointment;
    private User $tattooist;
    private User $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->tattooist = new User([
            'name' => 'Tatuador',
            'email' => 'tatuador@example.com',
            'password' => '123456',
            'password_confirmation' => '123456',
            'user_type' => 'T'
        ]);
        $this->tattooist->save();

        $this->user = new User([
            'name' => 'Usuario',
            'email' => 'usuario@example.com',
            'password' => '123456',
            'password_confirmation' => '123456',
            'user_type' => 'U'
        ]);
        $this->user->save();

        $this->appointment = new Appointment([
            'date' => '2025-12-31 10:00:00',
            'size' => 'medio',
            'location' => 'barriga',
            'status' => 'pendente',
            'users_id' => $this->user->id,
            'tattooists_id' => $this->tattooist->id
        ]);
        $this->appointment->save();
    }

    public function test_should_create_new_appointment(): void
    {
        $this->assertTrue($this->appointment->save());
        $this->assertCount(1, Appointment::all());
    }

    public function test_all_should_return_all_tattooistAppointments(): void
    {
        $appointments[] = $this->appointment;
        $appointments[] = $this->tattooist->tattoistsAppointments()->new([
            'date' => '2025-12-31 10:00:00',
            'size' => 'medio',
            'location' => 'perna',
            'status' => 'pendente',
            'users_id' => $this->user->id,
            'tattooists_id' => $this->tattooist->id
        ]);
        $appointments[1]->save();

        $all = Appointment::all();
        $this->assertCount(2, $all);
        $this->assertEquals($appointments, $all);
    }

    public function test_all_should_return_all_userAppointments(): void
    {
        $appointments[] = $this->appointment;
        $appointments[] = $this->tattooist->userAppointments()->new([
            'date' => '2025-12-31 10:00:00',
            'size' => 'medio',
            'location' => 'perna',
            'status' => 'pendente',
            'users_id' => $this->user->id,
            'tattooists_id' => $this->tattooist->id
        ]);
        $appointments[1]->save();

        $all = Appointment::all();
        $this->assertCount(2, $all);
        $this->assertEquals($appointments, $all);
    }

    public function test_destroy_should_remove_the_tattoistsAppointments(): void
    {
        $appointment2 = $this->tattooist->tattoistsAppointments()->new([
            'date' => '2025-12-31 10:00:00',
            'size' => 'medio',
            'location' => 'perna',
            'status' => 'pendente',
            'users_id' => $this->user->id,
            'tattooists_id' => $this->tattooist->id
        ]);

        $appointment2->save();
        $appointment2->destroy();

        $this->assertCount(1, Appointment::all());
    }

    public function test_destroy_should_remove_the_userAppointments(): void
    {
        $appointment2 = $this->tattooist->userAppointments()->new([
            'date' => '2025-12-31 10:00:00',
            'size' => 'medio',
            'location' => 'perna',
            'status' => 'pendente',
            'users_id' => $this->user->id,
            'tattooists_id' => $this->tattooist->id
        ]);

        $appointment2->save();
        $appointment2->destroy();

        $this->assertCount(1, Appointment::all());
    }

    public function test_set_size(): void
    {
        $appointment = $this->tattooist->tattoistsAppointments()->new([
            'date' => '2025-12-31 10:00:00',
            'size' => 'grande',
            'location' => 'perna',
            'status' => 'pendente',
            'users_id' => $this->user->id,
            'tattooists_id' => $this->tattooist->id
        ]);
        $this->assertEquals('grande', $appointment->size);
    }

    public function test_set_id(): void
    {
        $appointment = $this->tattooist->tattoistsAppointments()->new([
            'date' => '2025-12-31 10:00:00',
            'size' => 'medio',
            'location' => 'perna',
            'status' => 'pendente',
            'users_id' => $this->user->id,
            'tattooists_id' => $this->tattooist->id
        ]);
        $appointment->id = 7;

        $this->assertEquals(7, $appointment->id);
    }

    public function test_errors_should_return_date_error(): void
    {
        $appointment = $this->tattooist->tattoistsAppointments()->new([
            'date' => '2025-12-31 10:00:00',
            'size' => 'medio',
            'location' => 'perna',
            'status' => 'pendente',
            'users_id' => $this->user->id,
            'tattooists_id' => $this->tattooist->id
        ]);
        $appointment->date = '';

        $this->assertFalse($appointment->isValid());
        $this->assertFalse($appointment->save());
        $this->assertTrue($appointment->hasErrors());

        $this->assertEquals('não pode ser vazio!', $appointment->errors('date'));
    }

    public function test_find_by_id_should_return_the_appointment(): void
    {
        $appointment2 = $this->tattooist->tattoistsAppointments()->new([
            'date' => '2025-12-31 10:00:00',
            'size' => 'medio',
            'location' => 'perna',
            'status' => 'pendente',
            'users_id' => $this->user->id,
            'tattooists_id' => $this->tattooist->id
        ]);
        $appointment1 = $this->tattooist->tattoistsAppointments()->new([
            'date' => '2025-12-31 10:00:00',
            'size' => 'grande',
            'location' => 'perna',
            'status' => 'pendente',
            'users_id' => $this->user->id,
            'tattooists_id' => $this->tattooist->id
        ]);
        $appointment3 = $this->tattooist->tattoistsAppointments()->new([
            'date' => '2025-12-31 10:00:00',
            'size' => 'pequeno',
            'location' => 'perna',
            'status' => 'pendente',
            'users_id' => $this->user->id,
            'tattooists_id' => $this->tattooist->id
        ]);

        $appointment1->save();
        $appointment2->save();
        $appointment3->save();

        $this->assertEquals($appointment1, Appointment::findById($appointment1->id));
    }

    public function test_find_by_id_should_return_null(): void
    {
        $appointment = $this->tattooist->tattoistsAppointments()->new([
            'date' => '2025-12-31 10:00:00',
            'size' => 'medio',
            'location' => 'perna',
            'status' => 'pendente',
            'users_id' => $this->user->id,
            'tattooists_id' => $this->tattooist->id
        ]);
        $appointment->save();

        $this->assertNull(Appointment::findById(7));
    }

    public function test_appointment_should_have_a_user_and_a_tattooist(): void
    {

        $appointment = $this->tattooist->tattoistsAppointments()->new([
            'date' => '2025-12-31 10:00:00',
            'size' => 'medio',
            'location' => 'perna',
            'status' => 'pendente',
            'users_id' => $this->user->id,
            'tattooists_id' => $this->tattooist->id
        ]);
        $appointment->save();

        $this->assertEquals($this->user->id, $this->appointment->user->id);
        $this->assertEquals($this->tattooist->id, $this->appointment->tattooist->id);
    }
}
