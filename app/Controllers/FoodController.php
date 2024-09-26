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

        $foodName = $this->request->getPost('aliment');
        $quantity = $this->request->getPost('quantite');

        $foodModel = new FoodModel();
        $food = $foodModel->where('nom', $foodName)->first();

        if (!$food) {
            return redirect()->back()->with('error', 'Aliment non trouvé');
        }

        $caloriesIngested = ($food['calories_par_100g'] * $quantity) / 100;

        // Enregistrer dans records
        $recordModel = new RecordModel();
        $recordData = [
            'user_id'  => $userId,
            'type'     => 'nourriture',
            'item_id'  => $food['id'],
            'quantite' => $quantity,
            'calories' => $caloriesIngested,
        ];
        $recordModel->insert($recordData);

        // Calcul de l'activité recommandée
        $userModel = new UserModel();
        $user = $userModel->find($userId);
        $poids = $user['poids'];

        $activityModel = new ActivityModel();
        $activities = $activityModel->findAll();

        $activiteRecommandee = null;
        $tempsMinimum = PHP_INT_MAX;

        foreach ($activities as $activity) {
            $met = $activity['met'];
            $caloriesBruleesParMinute = ($met * 3.5 * $poids) / 200;
            $tempsNecessaire = $caloriesIngested / $caloriesBruleesParMinute;

            if ($tempsNecessaire < $tempsMinimum) {
                $tempsMinimum = $tempsNecessaire;
                $activiteRecommandee = $activity;
            }
        }

        $data = [
            'aliment'          => $foodName,
            'quantite'         => $quantity,
            'caloriesIngerees' => $caloriesIngested,
            'activite'         => $activiteRecommandee['nom'],
            'tempsNecessaire'  => round($tempsMinimum, 2),
            'imageActivite'    => $activiteRecommandee['image'],
        ];

        return view('result_food', $data);
    }
}