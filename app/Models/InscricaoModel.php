<?php

namespace App\Models;

use CodeIgniter\Model;

class InscricaoModel extends Model
{
    protected $table = "inscricao";

    protected $allowedFields = ['evento', 'usuario', 'tipo', 'criada_em', 'artigo'];

    public function encontraPorIdDoUsuario($id)
    {
        $query = $this->query('SELECT * FROM inscricao WHERE usuario = ' . $id . ';');
        return $query->getResult();
    }

    public function encontraPorIdDoUsuarioEEvento($userId, $eventoId)
    {
        $query = $this->query('SELECT * FROM inscricao WHERE usuario = ' . $userId . ' AND evento = ' . $eventoId . ';');
        return $query->getFirstRow();
    }
}
