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

        'kegiatanId',
        'tcmId',
        'created_at',
        'updated_at'
    ];

    public function getTrxTcmByKegiatanId($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        }

        return $this->select('*,trxtcm.id as trxTcmId')
            ->join('tcm', 'tcm.id = trxtcm.tcmId')
            ->where('trxtcm.kegiatanId', $id)
            ->findAll();
    }

    public function getTrxTcmByTcmId($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        }

        return $this->select('*,trxtcm.id as trxTcmId')
            ->join('tcm', 'tcm.id = trxtcm.tcmId')
            ->where('trxtcm.tcmId', $id)
            ->findAll();
    }

    public function getTrxTcmByTransferDariId($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        }

        return $this->select('*,trxtcm.id as trxTcmId')
            ->join('tcm', 'tcm.id = trxtcm.tcmId')
            ->where('tcm.transferDariId', $id)
            ->findAll();
    }

    public function getTrxTcmByKegiatanTransferDariId($transferDariId = false)
    {
        if ($transferDariId === false) {
            return $this->findAll();
        }

        return $this->select('kegiatan.*, trxtcm.*, tcm.*, trxtcm.id as trxTcmId')
            ->join('kegiatan', 'kegiatan.id = trxtcm.kegiatanId')
            ->join('tcm', 'tcm.id = trxtcm.tcmId')
            ->where('kegiatan.transferDariId', $transferDariId)
            ->findAll();
    }
}
