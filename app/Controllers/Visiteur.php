<?php

namespace App\Controllers;

class Visiteur extends BaseController
{
    public function accueil()
    {
        return view('templates/header') .
            view('visiteur/accueil') .
            view('templates/footer');
    }
}
