<?php

namespace App\Controllers;

use App\Models\EventoModel;
use App\Models\InscricaoModel;

class Home extends BaseController
{
    public function index()
    {
        $session = session();
        if ($session->get('logged_in') != null && $session->get('logged_in')) {
            return $this->home();
        } else {
            return view('login');
        }
    }

    public function home()
    {
        $model = model(EventoModel::class);

        $data['eventos'] = $model->mostraTodos();

        return view('home', $data);
    }

    public function account()
    {
        $model = model(InscricaoModel::class);

        $session = session();

        $data['inscricoes'] = $model->encontraPorIdDoUsuario($session->get('user_id'));

        return view('account', $data);
    }
}
