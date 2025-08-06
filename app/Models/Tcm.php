<?php

namespace App\Models;

use CodeIgniter\Model;

class Tcm extends Model
{
    protected $table            = 'tcm';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = [
        'jenisId',
        'status',
        'partNumber',
        'serialNumber',
        'created_at',
        'updated_at',
    ];
}
