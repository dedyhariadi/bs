<?php

namespace App\Models;

use CodeIgniter\Model;

class Surat extends Model
{
    protected $table            = 'surat';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = [

        'noSurat',
        'pejabat',
        'perihal',
        'tglSurat',
        'filePdf',
        'created_at',
        'updated_at',

    ];
}
