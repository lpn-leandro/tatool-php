<?php

namespace App\Controllers\Tattooists;

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
        $paginator = $this->current_user->tattooAppointments()->paginate(page: $request->getParam('page', 1));
        $appointments = $paginator->registers();

        $this->render('tattooists/appointments/index', compact('paginator', 'appointments', 'title'));
    }

    public function show(Request $request): void
    {
        $params = $request->getParams();

        $appointment = $this->current_user->appointments()->findById($params['id']);

        $title = "Visualização do Agendamento #{$appointment->id}";
        $this->render('appointments/show', compact('appointment', 'name'));
    }

    public function new(): void
    {
        $appointment = $this->current_user->appointments()->new();

        $title = 'Novo Problema';
        $this->render('appointments/new', compact('appointment', 'title'));
    }

    public function create(Request $request): void
    {
        $params = $request->getParams();
        $appointment = $this->current_user->appointments()->new($params['appointment']);

        if ($appointment->save()) {
            FlashMessage::success('Problema registrado com sucesso!');
            $this->redirectTo(route('appointments.index'));
        } else {
            FlashMessage::danger('Existem dados incorretos! Por verifique!');
            $title = 'Novo Problema';
            $this->render('appointments/new', compact('appointment', 'title'));
        }
    }

    public function edit(Request $request): void
    {
        $params = $request->getParams();
        $appointment = $this->current_user->appointments()->findById($params['id']);

        $title = "Editar Problema #{$appointment->id}";
        $this->render('appointments/edit', compact('appointment', 'title'));
    }

    public function update(Request $request): void
    {
        $id = $request->getParam('id');
        $params = $request->getParam('appointment');

        $appointment = $this->current_user->appointments()->findById($id);
        $appointment->title = $params['title'];

        if ($appointment->save()) {
            FlashMessage::success('Problema atualizado com sucesso!');
            $this->redirectTo(route('appointments.index'));
        } else {
            FlashMessage::danger('Existem dados incorretos! Por verifique!');
            $title = "Editar Problema #{$appointment->id}";
            $this->render('appointments/edit', compact('appointment', 'title'));
        }
    }

    public function destroy(Request $request): void
    {
        $params = $request->getParams();

        $appointment = $this->current_user->appointments()->findById($params['id']);
        $appointment->destroy();

        FlashMessage::success('Problema removido com sucesso!');
        $this->redirectTo(route('appointments.index'));
    }
}
