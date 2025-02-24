<?php

namespace App\Controllers\Users;

use App\Models\User;
use Core\Http\Controllers\Controller;
use Core\Http\Request;
use Lib\FlashMessage;
use Lib\Authentication\Auth;

class AppointmentsController extends Controller
{
    public function index(Request $request): void
    {
        $title = 'Agendamentos';
        $user = Auth::user();
        $paginator = $this->current_user->userAppointments()->paginate(page: $request->getParam('page', 1));
        $appointments = $paginator->registers();

        $this->render('users/appointments/index', compact('paginator', 'appointments', 'title'));
    }

    public function show(Request $request): void
    {
        $params = $request->getParams();

        $appointment = $this->current_user->userAppointments()->findById($params['id']);

        $title = "Visualização do Agendamento #{$appointment->id}";
        $this->render('users/appointments/show', compact('appointment', 'title'));
    }

    public function new(): void
    {
        $appointment = $this->current_user->userAppointments()->new();

        $tattooists = $this->getTattooists();

        $title = 'Novo Agendamento';
        $this->render('users/appointments/new', compact('appointment', 'tattooists', 'title'));
    }


    public function create(Request $request): void
    {
        $params = $request->getParams();
        $appointment = $this->current_user->userAppointments()->new($params['appointment']);

        /** @var \App\Models\Appointment $appointment */
        $appointment->users_id = $this->current_user->id;

        if ($appointment->save()) {
            FlashMessage::success('Agendamento registrado com sucesso!');
            $this->redirectTo(route('user.appointments.index'));
        } else {
            FlashMessage::danger('Existem dados incorretos! Por verifique!');
            $tattooists = $this->getTattooists();
            $title = 'Novo Agendamento';
            $this->render('users/appointments/new', compact('appointment', 'tattooists', 'title'));
        }
    }

    public function edit(Request $request): void
    {
        $params = $request->getParams();
        //dd($params);
        $appointment = $this->current_user->userAppointments()->findById($params['id']);

        $tattooists = $this->getTattooists();

        if (!$appointment) {
            FlashMessage::danger('Agendamento não encontrado!');
            $this->redirectTo(route('user.appointments.index'));
            return;
        }

        $title = "Editar Agendamento #{$appointment->id}";
        $this->render('users/appointments/edit', compact('appointment', 'title', 'tattooists'));
    }

    public function update(Request $request): void
    {
        $id = $request->getParam('id');
        $params = $request->getParam('appointment');

        $appointment = $this->current_user->userAppointments()->findById($id);

        $appointment->date = $params['date'];
        $appointment->size = $params['size'];
        $appointment->location = $params['location'];
        $appointment->status = $params['status'];
        $appointment->tattooists_id = $params['tattooists_id'];

        if ($appointment->save()) {
            FlashMessage::success('Agendamento atualizado com sucesso!');
            $this->redirectTo(route('user.appointments.index'));
        } else {
            FlashMessage::danger('Existem dados incorretos! Por verifique!');
            $title = "Editar Agendamento #{$appointment->id}";
            $tattooists = $this->getTattooists();
            $this->render('users/appointments/edit', compact('appointment', 'title', 'tattooists'));
        }
    }

    public function destroy(Request $request): void
    {
        $params = $request->getParams();

        $appointment = $this->current_user->userAppointments()->findById($params['id']);
        $appointment->destroy();

        FlashMessage::success('Agendamento removido com sucesso!');
        $this->redirectTo(route('user.appointments.index'));
    }

    /**
     * @return array<User>
     */
    private function getTattooists(): array
    {
        return User::where(['user_type' => 'T']);
    }
}
