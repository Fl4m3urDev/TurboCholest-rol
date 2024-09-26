<?php

namespace App\Models;

use CodeIgniter\Model;

class RecordModel extends Model
{
    protected $table      = 'records';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'user_id',
        'type',
        'item_id',
        'quantite',
        'calories',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = ''; // Si vous n'utilisez pas updated_at
}