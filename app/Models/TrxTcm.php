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

        return $this->select('trxtcm.id as trxTcmId, trxtcm.kegiatanId, trxtcm.tcmId, trxtcm.created_at, trxtcm.updated_at, tcm.*')
            ->join('tcm', 'tcm.id = trxtcm.tcmId')
            ->where('trxtcm.kegiatanId', $id)
            ->findAll();
    }

    public function getTrxTcmByTcmId($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        }

        return $this->select('trxtcm.id as trxTcmId, trxtcm.kegiatanId, trxtcm.tcmId, trxtcm.created_at, trxtcm.updated_at, tcm.*')
            ->join('tcm', 'tcm.id = trxtcm.tcmId')
            ->where('trxtcm.tcmId', $id)
            ->findAll();
    }



    public function getTrxTcmByKegiatanTransferKeId($transferKeId = false)
    {
        if ($transferKeId === false) {
            return $this->findAll();
        }

        return $this->select('kegiatan.*, trxtcm.*, tcm.*, trxtcm.id as trxTcmId')
            ->join('kegiatan', 'kegiatan.id = trxtcm.kegiatanId')
            ->join('tcm', 'tcm.id = trxtcm.tcmId')
            ->where('kegiatan.transferKeId', $transferKeId)
            ->findAll();
    }
}
