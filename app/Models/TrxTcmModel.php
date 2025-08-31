<?php

namespace App\Models;

use CodeIgniter\Model;

class TrxTcmModel extends Model
{
    protected $table = 'trxTcm';
    protected $primaryKey = 'id';
    protected $allowedFields = ['kegiatanId', 'tcmId', 'posisiId', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
    protected $returnType = 'array';

    /**
     * Get location of a specific TCM item
     * @param int $tcmId
     * @return array|null
     */
    public function getLocation($tcmId)
    {
        return $this->select('trxTcm.*, satkai.satkai AS lokasi, satkai.jenis AS jenis_lokasi')
            ->join('satkai', 'satkai.id = trxTcm.posisiId', 'left')
            ->where('trxTcm.tcmId', $tcmId)
            ->first();
    }

    /**
     * Get all TCM items at a specific location
     * @param string $lokasi
     * @return array
     */
    public function getItemsByLocation($lokasi)
    {
        return $this->select('trxTcm.*, tcm.serialNumber, tcm.status, tcm.partNumber, satkai.satkai AS lokasi')
            ->join('tcm', 'tcm.id = trxTcm.tcmId')
            ->join('satkai', 'satkai.id = trxTcm.posisiId')
            ->where('satkai.satkai', $lokasi)
            ->findAll();
    }

    /**
     * Get transfer history of a TCM item
     * @param int $tcmId
     * @return array
     */
    public function getTransferHistory($tcmId)
    {
        return $this->select('trxTcm.*, kegiatan.jenisGiat, kegiatan.tglPelaksanaan, kegiatan.keterangan,
                              satkai_dari.satkai AS dari, satkai_ke.satkai AS ke')
            ->join('kegiatan', 'kegiatan.id = trxTcm.kegiatanId')
            ->join('tcm', 'tcm.id = trxTcm.tcmId')
            ->join('satkai AS satkai_dari', 'satkai_dari.id = kegiatan.transferDariId', 'left')
            ->join('satkai AS satkai_ke', 'satkai_ke.id = kegiatan.transferKeId', 'left')
            ->where('trxTcm.tcmId', $tcmId)
            ->findAll();
    }

    /**
     * Get all transactions with full details
     * @return array
     */
    public function getAllWithDetails()
    {
        return $this->select('trxTcm.*, tcm.serialNumber, tcm.status, kegiatan.jenisGiat, satkai.satkai AS lokasi')
            ->join('tcm', 'tcm.id = trxTcm.tcmId')
            ->join('kegiatan', 'kegiatan.id = trxTcm.kegiatanId')
            ->join('satkai', 'satkai.id = trxTcm.posisiId', 'left')
            ->findAll();
    }

    /**
     * Update posisi TCM
     * @param int $tcmId
     * @param int $posisiId
     * @return bool
     */
    public function updatePosisi($tcmId, $posisiId)
    {
        return $this->where('tcmId', $tcmId)->set(['posisiId' => $posisiId])->update();
    }
}
