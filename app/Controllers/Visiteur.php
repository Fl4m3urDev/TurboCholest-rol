<?php

namespace App\Controllers;

use App\Models\ModeleActivite;
use App\Models\ModeleNourriture;

helper(['url', 'assets', 'form']);
class Visiteur extends BaseController
{
    public function accueil()
    {
        $data['TitreDeLaPage'] = 'Accueil';

        return view('templates/header') .
            view('visiteur/accueil', $data) .
            view('templates/footer');
    }

    public function classement()
    {
        $data['TitreDeLaPage'] = 'Classement des plus gros';

        return view('templates/header') .
            view('visiteur/classement', $data) .
            view('templates/footer');
    }

    public function formulaire_activite()
    {
        $data['TitreDeLaPage'] = 'Saisie d\'Activités';
        if (!$this->request->is('post')) {
            return view('templates/header')
            . view('visiteur/formulaire_activite', $data)
            . view('templates/footer');
        }

        $reglesValidation = [
            'txtNom' => 'required',
            'txtCalorie' => 'required|numeric',
        ];

        if (!$this->validate($reglesValidation)) {
            $data['TitreDeLaPage'] = "Saisie activite incorrecte";
            return view('templates/header')
            . view('visiteur/formulaire_activite', $data)
            . view('templates/footer');
        }

        $donneesAInserer = array(
            'name' => $this->request->getPost('txtNom'),
            'calories' => $this->request->getPost('txtCalorie'),
        );

        $modelActivite = new ModeleActivite();

        $donnees['activiteAjoute'] = $modelActivite->insert($donneesAInserer, false);

        return view('templates/header') .
            view('visiteur/voirCalculDepense', $data) .
            view('templates/footer');
    }

    public function formulaire_nourriture()
    {
        $data['TitreDeLaPage'] = 'Saisie Nourriture';
        if (!$this->request->is('post')) {
            return view('templates/header')
            . view('visiteur/formulaire_nourriture', $data)
            . view('templates/footer');
        }

        $reglesValidation = [
            'txtNom' => 'required',
            'txtCalorie' => 'required|numeric',
        ];

        if (!$this->validate($reglesValidation)) {
            $data['TitreDeLaPage'] = "Saisie nourriture incorrecte";
            return view('templates/header')
            . view('visiteur/formulaire_nourriture', $data)
            . view('templates/footer');
        }

        $donneesAInserer = array(
            'name' => $this->request->getPost('txtNom'),
            'calories' => $this->request->getPost('txtCalorie'),
        );

        $modelNourriture = new ModeleNourriture();

        $donnees['nourritureAjoute'] = $modelNourriture->insert($donneesAInserer, false);

        return view('templates/header') .
            view('visiteur/voirCalculDepense', $data) .
            view('templates/footer');
    }

    public function voirCalculDepense()
    {
        $data['TitreDeLaPage'] = 'Confirmation';

        return view('templates/header') .
            view('visiteur/voirCalculDepense', $data) .
            view('templates/footer');
    }
}
