<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function chooseAction()
    {
        return view('templates/header')
        .view('choose_action')
        .view('templates/footer');
    }
}

