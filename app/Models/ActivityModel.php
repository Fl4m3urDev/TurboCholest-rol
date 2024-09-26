<?php

namespace App\Models;

use CodeIgniter\Model;

class ActivityModel extends Model
{
    protected $table      = 'activities';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'nom',
        'met',
        'image',
    ];
}