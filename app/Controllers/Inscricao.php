<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\InscricaoModel;

class Inscricao extends BaseController
{
    public function ouvinte($evento)
    {
        $model = model(InscricaoModel::class);

        $session = session();

        $usuario = $session->get('user_id');
        $tipo = "Ouvinte";

        $model->save([
            'evento' => $evento,
            'usuario' => $usuario,
            'tipo' => $tipo,
            'criada_em' => date('Y-m-d H:i:s', strtotime('now'))
        ]);

        return redirect()->to('/account');
    }

    public function inscreverAutor()
    {
        $file = $this->request->getFile('pdfFile');
        $evento = $this->request->getPost('evento');

        if ($file && $file->isValid() && $file->getClientMimeType() === 'application/pdf') {
            $model = model(InscricaoModel::class);

            $session = session();

            $usuario = $session->get('user_id');
            $tipo = "Autor";
            $fileContent = file_get_contents($file->getTempName());

            $model->save([
                'evento' => $evento,
                'usuario' => $usuario,
                'tipo' => $tipo,
                'criada_em' => date('Y-m-d H:i:s', strtotime('now')),
                'artigo' => $fileContent
            ]);

            return redirect()->to('/account');
        } else {
            $session = session();
            $session->setFlashdata('alert', 'O arquivo precisa estar no formato PDF.');

            return redirect()->to('/autor/' . $evento);
        }
    }

    public function cancelar($id)
    {
        $model = model(InscricaoModel::class);

        $model->delete($id);

        return redirect()->to('/account');
    }
}
