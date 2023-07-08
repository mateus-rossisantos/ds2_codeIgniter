<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EventoModel;

class Eventos extends BaseController
{
    public function pesquisaEventos()
    {
        $searchValue = $this->request->getPost('searchValue');

        $model = model(EventoModel::class);

        $eventos = $model->pesquisarEventosPorNome($searchValue);

        $data['eventos'] = $eventos;

        return view('home', $data);
    }

    public function buscaEventoPorId($id)
    {
        $model = model(EventoModel::class);

        $evento = $model->buscaEventoPorId($id);

        return $evento;
    }

    public function autor($id)
    {
        $data['evento'] = $this->buscaEventoPorId($id);

        return view('tela_autor', $data);
    }
}
