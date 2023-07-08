<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EventoModel;

class Auth extends BaseController
{
    public function login()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $model = model(UsuarioModel::class);

        $user = $model->where([
            'email' => $email,
            'senha' => $password
        ])->first();

        if (isset($user)) {

            $session = session();

            $session_data = [
                'user_id'       => $user['id'],
                'user_name'     => $user['nome'],
                'user_email'    => $user['email'],
                'user_avatar'    => $user['avatar'],
                'logged_in'     => TRUE
            ];

            $session->set($session_data);

            return redirect()->to('/home');
        } else {
            $session = session();
            $session_data = [
                'erro_login' => TRUE,
                'logged_in' => FALSE
            ];

            $session->set($session_data);

            return redirect()->to('/');
        }
    }

    public function create()
    {
        return view('cadastro');
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to('/');
    }
}
