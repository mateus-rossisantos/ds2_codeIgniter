<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table = "usuario";

    protected $allowedFields = ['nome', 'email', 'senha', 'avatar', 'instituicao'];

    public function buscarPorEmail($email) {
        return $this->where(['email' => $email])->first();
    }
}
