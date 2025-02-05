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
    $title = 'Agendamentos';
    $user = Auth::user();
    $paginator = $this->current_user->tattoistsAppointments()->paginate(page: $request->getParam('page', 1));
    $appointments = $paginator->registers();
   
    $this->render('tattooists/appointments/index', compact('paginator','appointments','title'));
  }

  public function show(Request $request): void
    {
        $params = $request->getParams();

        $appointment = $this->current_user->tattoistsAppointments()->findById($params['id']);

        $title = "Visualização do Agendamento #{$appointment->id}";
        $this->render('appointments/show', compact('appointment', 'name'));
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

        $appointment->tattooists_id = $this->current_user->id;

        if ($appointment->save()) {
            FlashMessage::success('Problema registrado com sucesso!');
            $this->redirectTo(route('tattooists.appointments.index'));
        } else {
            FlashMessage::danger('Existem dados incorretos! Por verifique!');
            $users = $this->getUsers();
            $title = 'Novo Problema';
            $this->render('tattooists/appointments/new', compact('appointment','users', 'title'));
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

        $title = "Editar Problema #{$appointment->id}";
        $this->render('tattooists/appointments/edit', compact('appointment', 'title', 'users'));
    }

    public function update(Request $request): void
    {
        $id = $request->getParam('id');
        $params = $request->getParam('appointment');

        $appointment = $this->current_user->tattoistsAppointments()->findById($id);
        //$appointment->users_id = $params['users_id'];

        //dd($id, $params, $this->current_user->tattoistsAppointments()->findById($id));

        if ($appointment->save()) {
            FlashMessage::success('Agendamento atualizado com sucesso!');
            $this->redirectTo(route('tattooists.appointments.index'));
        } else {
            FlashMessage::danger('Existem dados incorretos! Por verifique!');
            $title = "Editar Agendamento #{$appointment->id}";
            $this->render('tattooist/appointments/edit', compact('appointment', 'title'));
        }
    }

    public function destroy(Request $request): void
    {
        $params = $request->getParams();

        $appointment = $this->current_user->tattoistsAppointments()->findById($params['id']);
        $appointment->destroy();

        FlashMessage::success('Problema removido com sucesso!');
        $this->redirectTo(route('tattooists.appointments.index'));
    }

    private function getUsers()
    {
            //return User::all();   
            return User::where(['user_type' => 'U']);


    }
}