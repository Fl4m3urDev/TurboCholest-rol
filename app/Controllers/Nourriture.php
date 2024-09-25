<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\ModeleNourriture;

helper(['url', 'assets', 'form']);
class Nourriture extends ResourceController
{
    // récupérer tous les aliments
    public function index()
    {
        $modNourriture = new ModeleNourriture();
        $donnees = $modNourriture->findAll();
        return $this->respond($donnees);
    }

    // récupérer un aliment
    public function show($name = null)
    {
        $modNourriture = new ModeleNourriture();
        $donnees = $modNourriture->getWhere(['name' => $name])->getResult();
        if($donnees){
            return $this->respond($donnees);
        }else{
            return $this->failNotFound('Pas de nourriture avec le nom '.$name);
        }
    }

    // créer un aliment
    public function create()
    {
        $modNourriture = new ModeleNourriture();
        $donnees = [
            'name' => $this->request->getVar('name'),
            'calories' => $this->request->getVar('calories')
        ];
        $modNourriture->insert($donnees);
        $response = [
            'status'   => 201,
            'error'    => null,
            'messages' => [
            'success' => 'Nourriture créé.'
            ]
        ];
        return $this->respondCreated($response);
    }

    // modifier un aliment
    public function update($reference = null)
    {
        $modNourriture = new ModeleNourriture();
        $json = $this->request->getJSON(true);
        $donnees = [
            'name' => $json["name"],
            'calories' => $json["calories"]
        ];
        $modNourriture->update($reference, $donnees);
        $response = [
            'status'   => 200,
            'error'    => null,
            'messages' => [
            'success' => 'Nourriture mis a jour.'
            ]
        ];
        return $this->respond($response);
    }

    // supprimer un aliment
    public function delete($name = null)
    {
        $modNourriture = new ModeleNourriture();
        $donnees = $modNourriture->find($name);
        if ($donnees) {
            $modNourriture->delete($name);
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                'success' => 'Nourriture supprimé'
                ]
            ];
            return $this->respondDeleted($response);
        } else {
            return $this->failNotFound('Pas de nourriture avec le nom '.$name);
        }
    }
}
