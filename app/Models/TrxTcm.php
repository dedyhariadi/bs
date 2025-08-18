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

    public function getAvailableTcmByTransferDariId($transferDariId = false, $currentKegiatanId = null)
    {
        if ($transferDariId === false) {
            return [];
        }

        $builder = $this->select('kegiatan.*, trxtcm.*, tcm.*, trxtcm.id as trxTcmId, tcm.id as tcmId')
            ->join('kegiatan', 'kegiatan.id = trxtcm.kegiatanId')
            ->join('tcm', 'tcm.id = trxtcm.tcmId')
            ->where('kegiatan.transferKeId', $transferDariId);

        // Jika ada currentKegiatanId, exclude TCM yang sudah ada dalam kegiatan tersebut
        if ($currentKegiatanId !== null) {
            $builder->whereNotIn('tcm.id', function($subquery) use ($currentKegiatanId) {
                return $subquery->select('tcmId')
                    ->from('trxtcm')
                    ->where('kegiatanId', $currentKegiatanId);
            });
        }

        return $builder->orderBy('trxtcm.created_at', 'DESC')
            ->findAll();
    }

    public function getHistoryPenempatan($idTcm)
    {
        return $this->select('trxtcm.*, tcm.partNumber, tcm.serialNumber, tcm.status, kegiatan.jenisGiat, kegiatan.transferKeId, satkai.satkai as lokasiPenempatan, trxtcm.id as trxTcmId')
            ->join('tcm', 'tcm.id = trxtcm.tcmId')
            ->join('kegiatan', 'kegiatan.id = trxtcm.kegiatanId')
            ->join('satkai', 'satkai.id = kegiatan.transferKeId')
            ->where('trxtcm.tcmId', $idTcm)
            ->orderBy('trxtcm.created_at', 'DESC')
            ->findAll();
    }
}
