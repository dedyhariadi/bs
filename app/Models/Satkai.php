<?php

namespace App\Models;

use CodeIgniter\Model;

class Satkai extends Model
{
    protected $table            = 'satkai';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = [
        'satkai',
        'jenis',
    ];
}
