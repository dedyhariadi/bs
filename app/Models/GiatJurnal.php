<?php

namespace App\Models;

use CodeIgniter\Model;

class GiatJurnal extends Model
{
    protected $table            = 'giatjurnal';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $useTimestamps = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'kegiatan'
    ];
}
