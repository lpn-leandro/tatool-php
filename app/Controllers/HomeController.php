<?php

namespace App\Controllers;

use Core\Http\Controllers\Controller;
use Core\Http\Request;
use Lib\FlashMessage;
use Lib\Authentication\Auth;

class HomeController extends Controller
{
    public function index(Request $request): void
    {
        $title = 'Home';
        $user = Auth::user();
        if ($user->isTattooist()) {
            $this->render('home/tattooistIndex', compact('title'));
        } else {
            $this->render('home/userIndex', compact('title'));
        }
    }


    public function appointments(Request $request): void
    {
        $user = Auth::user();

        $title = 'Agendamentos';
        if ($user->isTattooist()) {
            $this->render('appointments/tattooistAppointments', compact('title'));
        } else {
            $this->render('appointments/appointments', compact('title'));
        }
    }
}
