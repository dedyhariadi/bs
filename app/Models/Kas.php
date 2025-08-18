<?php

namespace App\Models;

use CodeIgniter\Model;

class Kas extends Model
{
    protected $table            = 'kas';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = [
        'tanggal',
        'keterangan',
        'pemasukan',
        'pengeluaran',
    ];
}
