<?php

namespace App\Models;

use CodeIgniter\Model;

class Kegiatan extends Model
{
    protected $table            = 'kegiatan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $useTimestamps = true;

    protected $allowedFields    = [
        'jenisGiat',
        'suratId',
        'transferDariId',
        'transferKeId',
        'tglPelaksanaan',
        'keterangan',
        'created_at',
        'updated_at',
    ];
}
