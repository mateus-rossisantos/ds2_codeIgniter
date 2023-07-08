<?php

namespace App\Models;

use CodeIgniter\Model;

class EventoModel extends Model
{
    protected $table = "evento";

    public function mostraTodos()
    {
        return $this->findAll();
    }

    public function pesquisarEventosPorNome($searchValue)
    {
        return $this->like('nome', $searchValue)->findAll();
    }

    public function buscaEventoPorId($id)
    {
        $query = $this->query('SELECT * FROM evento WHERE id = ' . $id . ';');
        return $query->getFirstRow();
    }
}
