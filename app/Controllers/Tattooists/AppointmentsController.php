<?php

namespace App\Controllers\Tattooists;

use App\Models\User;
use Core\Http\Controllers\Controller;
use Core\Http\Request;
use Lib\FlashMessage;
use Lib\Authentication\Auth;

class AppointmentsController extends Controller
{
    public function index(Request $request): void
    {
        if ($request->isJson()) {
            $appointments = $this->current_user->tattoistsAppointments()->get();
            if ($search = $request->getParam('search')) {
                $appointments = array_filter($appointments, fn($a) => stripos($a->user->name, $search) !== false);
            }
            echo json_encode(['appointments' => array_map(fn($a) => [
                'id' => $a->id,
                'date' => $a->date,
                'user' => ['name' => $a->user->name],
                'location' => $a->location,
                'size' => $a->size,
                'status' => $a->status
            ], $appointments)]);
            return;
        }

        $this->render('tattooists/appointments/index', [
            'title' => 'Agendamentos',
            'appointments' => $this->current_user->tattoistsAppointments()->paginate(page: $request->getParam(
                'page',
                1
            ))->registers()
        ]);
    }

    public function show(Request $request): void
    {
        $params = $request->getParams();

        $appointment = $this->current_user->tattoistsAppointments()->findById($params['id']);

        $title = "Visualização do Agendamento #{$appointment->id}";
        $this->render('tattooists/appointments/show', compact('appointment', 'title'));
    }

    public function new(): void
    {
        $appointment = $this->current_user->tattoistsAppointments()->new();

        $users = $this->getUsers();

        $title = 'Novo Agendamento';
        $this->render('tattooists/appointments/new', compact('appointment', 'users', 'title'));
    }


    public function create(Request $request): void
    {
        $params = $request->getParams();
        $appointment = $this->current_user->tattoistsAppointments()->new($params['appointment']);

        /** @var \App\Models\Appointment $appointment */
        $appointment->tattooists_id = $this->current_user->id;

        if ($appointment->save()) {
            FlashMessage::success('Agendamento registrado com sucesso!');
            $this->redirectTo(route('tattooists.appointments.index'));
        } else {
            FlashMessage::danger('Existem dados incorretos! Verifique!');
            $users = $this->getUsers();
            $title = 'Novo Agendamento';
            $this->render('tattooists/appointments/new', compact('appointment', 'users', 'title'));
        }
    }

    public function edit(Request $request): void
    {
        $params = $request->getParams();
        //dd($params);
        $appointment = $this->current_user->tattoistsAppointments()->findById($params['id']);

        $users = $this->getUsers();

        if (!$appointment) {
            FlashMessage::danger('Agendamento não encontrado!');
            $this->redirectTo(route('tattooists.appointments.index'));
            return;
        }

        $title = "Editar Agendamento #{$appointment->id}";
        $this->render('tattooists/appointments/edit', compact('appointment', 'title', 'users'));
    }

    public function update(Request $request): void
    {
        $id = $request->getParam('id');
        $params = $request->getParam('appointment');

        $appointment = $this->current_user->tattoistsAppointments()->findById($id);

        $appointment->date = $params['date'];
        $appointment->size = $params['size'];
        $appointment->location = $params['location'];
        $appointment->status = $params['status'];
        $appointment->users_id = $params['users_id'];

        if ($appointment->save()) {
            FlashMessage::success('Agendamento atualizado com sucesso!');
            $this->redirectTo(route('tattooists.appointments.index'));
        } else {
            FlashMessage::danger('Existem dados incorretos! Por favor, verifique!');
            $title = "Editar Agendamento #{$appointment->id}";
            $users = $this->getUsers();
            $this->render('tattooists/appointments/edit', compact('appointment', 'title', 'users'));
        }
    }

    public function destroy(Request $request): void
    {
        $params = $request->getParams();

        $appointment = $this->current_user->tattoistsAppointments()->findById($params['id']);
        $appointment->destroy();

        FlashMessage::success('Agendamento removido com sucesso!');
        $this->redirectTo(route('tattooists.appointments.index'));
    }

    /**
     * @return array<User>
     */
    private function getUsers(): array
    {
            //return User::all();
            return User::where(['user_type' => 'U']);
    }
}
