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
        $data['TitreDeLaPage'] = 'Saisie d\'Activités';

        $rules = [
            'txtNom' => 'required',
            'txtCalorie' => 'required',
        ];
        $messages = [
            'txtNom' => [
                'required' => "Veuillez renseigner le nom",
            ],
            'txtCalorie' => [
                'required' => "Veuillez renseigner le nombre de calorie",
            ]
        ];

        if (!$this->validate($rules, $messages)) {
            if ($_POST) $data['TitreDeLaPage'] = "Corriger votre activite";
            return view('templates/header') .
                view('activite/formulaire_activite', $data) .
                view('templates/footer');
        } else {
            $donneesAInserer = array(
                'name' => $this->request->getPost('txtNom'),
                'calories' => $this->request->getPost('txtCalorie')
            );

            $modeleActivite = new ModeleActivite();
            $donnees['nbDeLignesAffectees'] = $modeleActivite->save($donneesAInserer);
            return view('visiteur/voirCalculDepense', $donnees);
        }
    }
}
