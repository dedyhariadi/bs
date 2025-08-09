<?php

namespace App\Models;

use CodeIgniter\Model;

class Jurnal extends Model
{
    protected $table            = 'jurnal';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $useTimestamps     = true;
    protected $dateFormat       = 'datetime';
    protected $allowedFields    = [
        'tanggal',
        'jenis',
        'kegiatan',
        'foto',
        'created_at',
        'updated_at',
    ];
}
