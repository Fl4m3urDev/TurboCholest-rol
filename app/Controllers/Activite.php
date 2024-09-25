<?php

namespace App\Controllers;

use App\Models\ModeleActivite;

helper(['url', 'assets', 'form']);
class Activite extends BaseController
{
    // protected $activityModel;

    // public function __construct()
    // {
    //     $this->activityModel = new ActivityModel();
    // }

    public function formulaire_activite()
    {
        return view('templates/header') .
            view('activite/formulaire_activite') .
            view('templates/footer');
    }

    public function save()
    {
        $modeleActivite = new ModeleActivite();

        $data = [
            'nom' => $this->request->getPost('nom'),
            'calories_brulées_par_minute' => $this->request->getPost('calories')
        ];

        $modeleActivite->save($data);

        return redirect()->to('/')->with('success', 'Activité ajoutée avec succès.');
    }
}
