<?php

namespace App\Controllers;

helper(['url', 'assets', 'form']);
class Visiteur extends BaseController
{
    public function accueil()
    {
        return view('templates/header').
        view('visiteur/accueil').
        view('templates/footer');
    }

    public function classement()
    {
        return view('templates/header').
        view('visiteur/classement').
        view('templates/footer');
    }

    public function voirCalculDepense()
    {
        $data['TitreDeLaPage'] = 'Confirmation';

        return view('templates/header').
        view('visiteur/voirCalculDepense', $data).
        view('templates/footer');
        if ($this->input->post('submit')) {
            return redirect()->to('visiteur/voirCalculDepense');
        }
    }
}