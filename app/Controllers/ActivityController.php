<?php

namespace App\Controllers;

use App\Models\ActivityModel;

class ActivityController extends BaseController
{
    protected $activityModel;

    public function __construct()
    {
        helper('form');

        $this->activityModel = new ActivityModel();
    }


    public function index()
    {
        return view('templates/header') .
            view('activity_form') .
            view('templates/footer');
    }


    public function save()
    {

        $data = [
            'nom' => $this->request->getPost('nom'),
            'calories_brulées_par_minute' => $this->request->getPost('calories')
        ];

        $this->activityModel->save($data);


        return redirect()->to('/')->with('success', 'Activité ajoutée avec succès.');
    }
}
