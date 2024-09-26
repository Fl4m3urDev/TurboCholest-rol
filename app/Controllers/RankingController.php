<?php

namespace App\Controllers;

use App\Models\RecordModel;
use App\Models\UserModel;
use CodeIgniter\Controller;

class RankingController extends Controller
{
    public function index()
    {
        $recordModel = new RecordModel();
        $userModel = new UserModel();

        // Classement des gros mangeurs
        $eaters = $recordModel->select('user_id, SUM(calories) as total_calories')
            ->where('type', 'nourriture')
            ->groupBy('user_id')
            ->orderBy('total_calories', 'DESC')
            ->findAll(10);

        // Ajout des noms d'utilisateurs
        foreach ($eaters as &$eater) {
            $user = $userModel->find($eater['user_id']);
            $eater['nom'] = 'Utilisateur ' . $user['id']; // Vous pouvez personnaliser cela
        }

        // Classement des plus sportifs
        $athletes = $recordModel->select('user_id, SUM(calories) as total_calories')
            ->where('type', 'activite')
            ->groupBy('user_id')
            ->orderBy('total_calories', 'DESC')
            ->findAll(10);

        foreach ($athletes as &$athlete) {
            $user = $userModel->find($athlete['user_id']);
            $athlete['nom'] = 'Utilisateur ' . $user['id'];
        }

        $data = [
            'eaters'   => $eaters,
            'athletes' => $athletes,
        ];

        return view('ranking', $data);
    }
}