<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class UserController extends Controller
{
    public function enterPersonalData()
    {
        return view('enter_personal_data');
    }

    public function savePersonalData()
    {
        $session = session();
        $model = new UserModel();

        $data = [
            'poids'           => $this->request->getPost('poids'),
            'taille'          => $this->request->getPost('taille'),
            'sexe'            => $this->request->getPost('sexe'),
            'niveau_activite' => $this->request->getPost('niveau_activite'),
            'age'             => $this->request->getPost('age'),
        ];

        if (!$model->insert($data)) {
            return redirect()->back()->with('errors', $model->errors());
        }

        $userId = $model->getInsertID();
        $session->set('user_id', $userId);

        return redirect()->to('/choose-action');
    }
}