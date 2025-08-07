<?php

namespace App\Models;

use CodeIgniter\Model;

class TrxTcm extends Model
{
    protected $table            = 'trxtcm';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = [

        'suratId',
        'posisiId',
        'keterangan',
        'tcmId',
        'giat',
        'tglPelaksanaan',
        'created_at',
        'updated_at'
    ];
}
