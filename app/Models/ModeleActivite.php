<?php

namespace App\Models;

use CodeIgniter\Model;

class ModeleActivite extends Model
{
    protected $table = 'activities';
    protected $primaryKey = 'id'; // Clé primaire
    protected $allowedFields = ['nom', 'calories_brulées_par_minute'];
}
