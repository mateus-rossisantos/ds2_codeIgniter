<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsuarioModel;

class Usuario extends BaseController
{
    public function index()
    {
        //
    }

    public function cadastro()
    {
        $file = $this->request->getFile('photo');
        $email = $this->request->getPost('email');
        $nome = $this->request->getPost('name');
        $password = $this->request->getPost('password');
        $instituicao = $this->request->getPost('instituicao');

        $model = model(UsuarioModel::class);

        $usuario = $model->buscarPorEmail($email);

        if ($usuario) {
            $session = session();
            $session->setFlashdata('alertEmail', 'Email já cadastrado.');

            return redirect()->to('/create');
        }

        if ($file) {
            if ($file->isValid() && $file->getClientMimeType() === 'image/jpeg') {

                $model->save([
                    'nome' => $nome,
                    'email' => $email,
                    'senha' => $password,
                    'avatar' => $file,
                    'instituicao' => $instituicao,
                ]);

                return redirect()->to('/');
            } else {
                $session = session();
                $session->setFlashdata('alert', 'O arquivo precisa estar no formato JPG.');

                return redirect()->to('/create');
            }
        } else {
            $model->save([
                'nome' => $nome,
                'email' => $email,
                'senha' => $password,
                'instituicao' => $instituicao,
            ]);

            return redirect()->to('/');
        }
    }
}
