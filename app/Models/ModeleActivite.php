<?php

namespace App\Models;

use CodeIgniter\Model;

class ModeleActivite extends Model
{
    protected $table = 'aliment';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'is_visible', 'met'];
}
