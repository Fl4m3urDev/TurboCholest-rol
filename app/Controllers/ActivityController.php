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

        $activityName = $this->request->getPost('activite');
        $duration     = $this->request->getPost('duree');

        $activityModel = new ActivityModel();
        $activity = $activityModel->where('nom', $activityName)->first();

        if (!$activity) {
            return redirect()->back()->with('error', 'Activité non trouvée');
        }

        $userModel = new UserModel();
        $user = $userModel->find($userId);
        $poids = $user['poids'];

        $met = $activity['met'];
        $caloriesBurnedPerMinute = ($met * 3.5 * $poids) / 200;
        $caloriesBurned = $caloriesBurnedPerMinute * $duration;

        // Enregistrer dans records
        $recordModel = new RecordModel();
        $recordData = [
            'user_id'  => $userId,
            'type'     => 'activite',
            'item_id'  => $activity['id'],
            'quantite' => $duration,
            'calories' => $caloriesBurned,
        ];
        $recordModel->insert($recordData);

        // Calcul de la nourriture équivalente
        $foodModel = new FoodModel();
        $foods = $foodModel->findAll();

        $alimentRecommande = null;
        $quantiteMinimum = PHP_INT_MAX;

        foreach ($foods as $food) {
            $caloriesPar100g = $food['calories_par_100g'];
            $quantiteNecessaire = ($caloriesBurned * 100) / $caloriesPar100g;

            if ($quantiteNecessaire < $quantiteMinimum) {
                $quantiteMinimum = $quantiteNecessaire;
                $alimentRecommande = $food;
            }
        }

        $data = [
            'activite'           => $activityName,
            'duree'              => $duration,
            'caloriesDepensees'  => $caloriesBurned,
            'aliment'            => $alimentRecommande['nom'],
            'quantiteNecessaire' => round($quantiteMinimum, 2),
            'imageAliment'       => $alimentRecommande['image'],
        ];

        return view('result_activity', $data);
    }
}