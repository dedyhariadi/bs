<?php

namespace App\Models;

use CodeIgniter\Model;

class Posisi extends Model
{
    protected $table            = 'posisi';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = [
        'posisi',
        'jenis',
    ];
}
