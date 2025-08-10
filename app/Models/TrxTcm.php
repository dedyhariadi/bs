<?php

namespace App\Models;

use CodeIgniter\Model;

class TrxTcm extends Model
{
    protected $table            = 'trxtcm';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $useTimestamps = true;
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

    public function getTrxTcmByKegiatanId($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        }

        return $this->select('*')
            ->join('tcm', 'tcm.id = trxtcm.tcmId')
            ->where('trxtcm.kegiatanId', $id)
            ->findAll();
    }
}
