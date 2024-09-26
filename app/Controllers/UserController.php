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

        // Récupérer les données du formulaire
        $data = [
            'poids'           => $this->request->getPost('poids'),
            'taille'          => $this->request->getPost('taille'),
            'sexe'            => $this->request->getPost('sexe'),
            'niveau_activite' => $this->request->getPost('niveau_activite'),
            'age'             => $this->request->getPost('age'),
        ];

        // Validation des données
        if (!$this->validate([
            'poids' => 'required|numeric',
            'taille' => 'required|numeric',
            'age' => 'required|numeric',
            'sexe' => 'required|in_list[homme,femme]',
            'niveau_activite' => 'required|in_list[sedentaire,faible,modere,actif,tres_actif]',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Calcul du BMR (Basal Metabolic Rate)
        $poids = $data['poids'];
        $taille = $data['taille'];
        $age = $data['age'];
        $sexe = $data['sexe'];

        if ($sexe == 'homme') {
            $bmr = 10 * $poids + 6.25 * $taille - 5 * $age + 5;
        } else {
            $bmr = 10 * $poids + 6.25 * $taille - 5 * $age - 161;
        }

        // Ajouter le BMR aux données à sauvegarder
        $data['bmr'] = $bmr;

        // Enregistrer les données utilisateur dans la base de données
        if (!$model->insert($data)) {
            return redirect()->back()->withInput()->with('errors', $model->errors());
        }

        
        $userId = $model->getInsertID();

        // Stocker l'ID utilisateur en session
        $session->set('user_id', $userId);

        // Rediriger vers la page de choix d'action
        return redirect()->to('/choose-action');
    }
}