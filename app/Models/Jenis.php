<?php

namespace App\Models;

use CodeIgniter\Model;

class Jenis extends Model
{
    protected $table            = 'jenis';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = [
        'nama',
        'file',
        'created_at',
        'updated_at',
    ];
}
