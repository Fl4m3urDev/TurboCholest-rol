<?php

namespace App\Controllers;

use App\Models\ActivityModel;
use App\Models\RecordModel;
use App\Models\UserModel;
use App\Models\FoodModel;
use CodeIgniter\Controller;

class ActivityController extends Controller
{
    public function enterActivity()
    {
        return view('enter_activity');
    }

    public function calculateFood()
    {
        $session = session();
        $userId = $session->get('user_id');

        // Validation de la session utilisateur
        if (!$userId) {
            return redirect()->to('/entrer-donnees-personnelles')->with('error', 'Veuillez entrer vos informations personnelles.');
        }

        // Récupérer les données du formulaire
        $activityName = $this->request->getPost('activite');
        $duration     = $this->request->getPost('duree');

        // Validation des données
        if (!$this->validate([
            'activite' => 'required',
            'duree' => 'required|numeric',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Recherche de l'activité dans la base de données
        $activityModel = new ActivityModel();
        $activity = $activityModel->where('nom', $activityName)->first();

        if (!$activity) {
            return redirect()->back()->with('error', 'Activité non trouvée');
        }

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

        // Calcul des calories dépensées
        $met = $activity['met'];
        $caloriesBurnedPerMinute = ($met * 3.5 * $poids) / 200;
        $caloriesBurned = $caloriesBurnedPerMinute * $duration;

        // Calcul du pourcentage du TDEE dépensé
        $pourcentageTDEE = ($caloriesBurned / $tdee) * 100;

        // Enregistrement de l'action dans records
        $recordModel = new RecordModel();
        $recordData = [
            'user_id'  => $userId,
            'type'     => 'activite',
            'item_id'  => $activity['id'],
            'quantite' => $duration,
            'calories' => $caloriesBurned,
        ];
        $recordModel->insert($recordData);

        // Recherche de la nourriture équivalente
        $foodModel = new FoodModel();
        $foods = $foodModel->findAll();

        $alimentRecommande = null;
        $quantiteMinimum = PHP_INT_MAX;

        foreach ($foods as $food) {
            $caloriesPar100g = $food['calories_par_100g'];
            if ($caloriesPar100g <= 0) {
                continue; // Évite la division par zéro
            }
            $quantiteNecessaire = ($caloriesBurned * 100) / $caloriesPar100g;

            if ($quantiteNecessaire < $quantiteMinimum) {
                $quantiteMinimum = $quantiteNecessaire;
                $alimentRecommande = $food;
            }
        }

        if (!$alimentRecommande) {
            return redirect()->back()->with('error', 'Aucune nourriture appropriée trouvée.');
        }

        // Préparer les données pour la vue
        $data = [
            'activite'           => $activityName,
            'duree'              => $duration,
            'caloriesDepensees'  => round($caloriesBurned, 2),
            'aliment'            => $alimentRecommande['nom'],
            'quantiteNecessaire' => round($quantiteMinimum, 2),
            'imageAliment'       => $alimentRecommande['image'],
            'tdee'               => round($tdee, 2),
            'pourcentageTDEE'    => round($pourcentageTDEE, 2),
        ];

        return view('result_activity', $data);
    }
}