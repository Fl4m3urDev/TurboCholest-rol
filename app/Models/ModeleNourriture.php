<?php

namespace App\Models;

use CodeIgniter\Model;

class ModeleNourriture extends Model
{
    protected $table = 'aliment';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'calories'];
}
