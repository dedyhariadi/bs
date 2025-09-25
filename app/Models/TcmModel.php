<?php

namespace App\Models;

use CodeIgniter\Model;

class TcmModel extends Model
{
    protected $table = 'tcm';
    protected $primaryKey = 'id';
    protected $allowedFields = ['jenisId', 'status', 'partNumber', 'serialNumber', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
    protected $returnType = 'array';

    /**
     * Get TCM item by ID with jenis details
     */
    public function getWithJenis($id)
    {
        return $this->select('tcm.*, jenis.nama as jenis_nama, jenis.file as jenis_file')
            ->join('jenis', 'jenis.id = tcm.jenisId')
            ->where('tcm.id', $id)
            ->first();
    }

    /**
     * Get all TCM items with jenis details
     */
    public function getAllWithJenis()
    {
        return $this->select('tcm.*, jenis.nama as jenis_nama')
            ->join('jenis', 'jenis.id = tcm.jenisId')
            ->findAll();
    }

    /**
     * Get TCM by serial number
     */
    public function getBySerial($serialNumber)
    {
        return $this->where('serialNumber', $serialNumber)->first();
    }

    /**
     * Get TCM items by jenis ID with jenis details
     */
    public function getTcmByJenis($jenisId)
    {
        return $this->select('tcm.partNumber AS part_number, tcm.serialNumber AS serial_number, tcm.status, trxTcm.kondisi, satkai.satkai AS posisi')
            ->join('jenistcm', 'jenistcm.id = tcm.jenisId')
            ->join('trxTcm', 'trxTcm.tcmId = tcm.id', 'left')
            ->join('satkai', 'satkai.id = trxTcm.posisiId', 'left')
            ->where('tcm.jenisId', $jenisId)
            ->findAll();
    }



    /**
     * Get TCM items by kegiatan ID with related details
     */
    public function getTcmByKegiatanId($kegiatanId)
    {
        return $this->select('tcm.*, jenistcm.nama as jenisTcm, trxTcm.kondisi, satkai.satkai as posisi, trxTcm.id as idTrxTcm')
            ->join('jenistcm', 'jenistcm.id = tcm.jenisId')
            ->join('trxTcm', 'trxTcm.tcmId = tcm.id', 'left')
            ->join('satkai', 'satkai.id = trxTcm.posisiId', 'left')
            ->where('trxTcm.kegiatanId', $kegiatanId)
            ->findAll();
    }


    /**
     * Get trxTcm records by jenisId with related details
     */
    public function getTrxTcmByJenisId($jenisId)
    {
        return $this->db->table('trxTcm')
            ->select('trxTcm.*, tcm.partNumber, tcm.serialNumber, jenistcm.nama as jenis_nama, satkai.satkai as posisi,kegiatan.tglpelaksanaan as tgl_pelaksanaan,jenistcm.id as jenisTcmId')
            ->join('tcm', 'tcm.id = trxTcm.tcmId')
            ->join('jenistcm', 'jenistcm.id = tcm.jenisId')
            ->join('satkai', 'satkai.id = trxTcm.posisiId', 'left')
            ->join('kegiatan', 'kegiatan.id = trxTcm.kegiatanId')
            ->where('tcm.jenisId', $jenisId)
            ->orderBy('kegiatan.tglPelaksanaan')
            ->get()
            ->getResultArray();
    }
}
