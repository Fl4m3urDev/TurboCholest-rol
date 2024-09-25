<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\ModeleActivite;

helper(['url', 'assets', 'form']);
class Activite extends ResourceController
{
    // récupérer tous les activites
    public function index()
    {
        $modActivite = new ModeleActivite();
        $donnees = $modActivite->findAll();
        return $this->respond($donnees);
    }

    // récupérer une activite
    public function show($name = null)
    {
        $modActivite = new ModeleActivite();
        $donnees = $modActivite->getWhere(['name' => $name])->getResult();
        if($donnees){
            return $this->respond($donnees);
        }else{
            return $this->failNotFound('Pas d\'activite avec le nom '.$name);
        }
    }

    // créer une activite
    public function create()
    {
        $modActivite = new ModeleActivite();
        $donnees = [
            'name' => $this->request->getVar('name'),
            'is_visible' => $this->request->getVar('is_visible'),
            'met' => $this->request->getVar('met')
        ];
        $modActivite->insert($donnees);
        $response = [
            'status'   => 201,
            'error'    => null,
            'messages' => [
            'success' => 'Activite créé.'
            ]
        ];
        return $this->respondCreated($response);
    }

    // modifier une activite
    public function update($reference = null)
    {
        $modActivite = new ModeleActivite();
        $json = $this->request->getJSON(true);
        $donnees = [
            'name' => $json["name"],
            'is_visible' => $json["is_visible"],
            'met' => $json["met"]
        ];
        $modActivite->update($reference, $donnees);
        $response = [
            'status'   => 200,
            'error'    => null,
            'messages' => [
            'success' => 'Activite mis a jour.'
            ]
        ];
        return $this->respond($response);
    }

    // supprimer une activite
    public function delete($name = null)
    {
        $modActivite = new ModeleActivite();
        $donnees = $modActivite->find($name);
        if ($donnees) {
            $modActivite->delete($name);
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                'success' => 'Activite supprimé'
                ]
            ];
            return $this->respondDeleted($response);
        } else {
            return $this->failNotFound('Pas d\'activite avec le nom '.$name);
        }
    }
}
