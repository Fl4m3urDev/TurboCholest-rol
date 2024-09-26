<?php

namespace App\Controllers;

use App\Models\FoodModel;
use App\Models\RecordModel;
use App\Models\UserModel;
use App\Models\ActivityModel;
use CodeIgniter\Controller;

class FoodController extends Controller
{
    public function enterFood()
    {
        return view('enter_food');
    }

    public function calculateActivity()
    {
        $session = session();
        $userId = $session->get('user_id');

        // Validation de la session utilisateur
        if (!$userId) {
            return redirect()->to('/entrer-donnees-personnelles')->with('error', 'Veuillez entrer vos informations personnelles.');
        }

        // Récupérer les données du formulaire
        $foodName = $this->request->getPost('aliment');
        $quantity = $this->request->getPost('quantite');

        // Validation des données
        if (!$this->validate([
            'aliment' => 'required',
            'quantite' => 'required|numeric',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Recherche de l'aliment dans la base de données
        $foodModel = new FoodModel();
        $food = $foodModel->where('nom', $foodName)->first();

        if (!$food) {
            return redirect()->back()->with('error', 'Aliment non trouvé');
        }

        // Calcul des calories ingérées
        $caloriesIngested = ($food['calories_par_100g'] * $quantity) / 100;

        // Enregistrement dans la table records
        $recordModel = new RecordModel();
        $recordData = [
            'user_id'  => $userId,
            'type'     => 'nourriture',
            'item_id'  => $food['id'],
            'quantite' => $quantity,
            'calories' => $caloriesIngested,
        ];
        $recordModel->insert($recordData);

        // Récupérer les données utilisateur pour les calculs
        $userModel = new UserModel();
        $user = $userModel->find($userId);
        $poids = $user['poids'];
        $bmr = $user['bmr'];
        $niveauActivite = $user['niveau_activite'];

        // Calcul du TDEE (Total Daily Energy Expenditure)
        $facteursActivite = [
            'sedentaire' => 1.2,
            'faible'     => 1.375,
            'modere'     => 1.55,
            'actif'      => 1.725,
            'tres_actif' => 1.9,
        ];
        $tdee = $bmr * $facteursActivite[$niveauActivite];

        // Calcul du pourcentage du TDEE consommé
        $pourcentageTDEE = ($caloriesIngested / $tdee) * 100;

        // Recherche de l'activité recommandée
        $activityModel = new ActivityModel();
        $activities = $activityModel->findAll();

        $activiteRecommandee = null;
        $tempsMinimum = PHP_INT_MAX;

        foreach ($activities as $activity) {
            $met = $activity['met'];
            $caloriesBruleesParMinute = ($met * 3.5 * $poids) / 200;
            if ($caloriesBruleesParMinute <= 0) {
                continue; // Évite la division par zéro
            }
            $tempsNecessaire = $caloriesIngested / $caloriesBruleesParMinute;

            if ($tempsNecessaire < $tempsMinimum) {
                $tempsMinimum = $tempsNecessaire;
                $activiteRecommandee = $activity;
            }
        }

        if (!$activiteRecommandee) {
            return redirect()->back()->with('error', 'Aucune activité appropriée trouvée.');
        }

        // Préparer les données pour la vue
        $data = [
            'aliment'          => $foodName,
            'quantite'         => $quantity,
            'caloriesIngerees' => round($caloriesIngested, 2),
            'activite'         => $activiteRecommandee['nom'],
            'tempsNecessaire'  => round($tempsMinimum, 2),
            'imageActivite'    => $activiteRecommandee['image'],
            'tdee'             => round($tdee, 2),
            'pourcentageTDEE'  => round($pourcentageTDEE, 2),
        ];

        return view('result_food', $data);
    }
}