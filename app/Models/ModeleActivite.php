<?php

namespace App\Models;

use CodeIgniter\Model;

class ModeleActivite extends Model
{
    protected $table = 'aliment';
    protected $primaryKey = 'id'; // Clé primaire
    protected $allowedFields = ['name', 'calories'];
}
