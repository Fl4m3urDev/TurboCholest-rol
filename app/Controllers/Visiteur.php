<?php

namespace App\Controllers;

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
}
