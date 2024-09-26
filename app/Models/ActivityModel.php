<?php

namespace App\Models;

use CodeIgniter\Model;

class ActivityModel extends Model

{
    protected $table = 'activities'; 
    protected $primaryKey = 'id'; 
    protected $allowedFields = ['nom', 'calories_brulées_par_minute']; 
}