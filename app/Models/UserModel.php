<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'users';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'poids',
        'taille',
        'sexe',
        'niveau_activite',
        'age',
        'bmr',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
}