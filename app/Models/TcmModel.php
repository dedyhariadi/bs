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



    public function getJenisTcmCounts()
    {
        // $subquery = $this->db->table('trxTcm')
        //     ->select('tcmId, MAX(updated_at) as latest_updated, kondisi')
        //     ->groupBy('tcmId');

        $subquery = $this->db->table('trxTcm')
            ->select('tcmId, MAX(updated_at) as latest_updated, kondisi')
            ->groupBy('tcmId')
            ->getCompiledSelect();

        return $this->db->table('tcm')
            ->select('jenistcm.nama as jenis, COUNT(tcm.id) as count,jenistcm.id as jenisId')
            ->join('jenistcm', 'jenistcm.id = tcm.jenisId')
            ->join("($subquery) as latest_trx", 'latest_trx.tcmId = tcm.id')
            ->groupBy('jenistcm.id')
            ->get()
            ->getResultArray();
    }

    public function getTcmCountsPerJenisSatkai()
    {
        // Subquery untuk ambil posisi terakhir per tcmId
        $subquery = $this->db->table('trxTcm')
            ->select('tcmId, MAX(updated_at) as latest_updated')
            ->groupBy('tcmId');

        $builder = $this->db->table('satkai s');
        $builder->select('s.jenis, jenistcm.nama AS jenisTcm, 
                      COUNT(DISTINCT trx.tcmId) AS tcmCount,
                      COUNT(CASE WHEN trx.kondisi = "OK" THEN 1 END) AS countOK,
                      COUNT(CASE WHEN trx.kondisi = "NOT OK" THEN 1 END) AS countNotOK, jenistcm.id as jenisId');  // Tambah countOK dan countNotOK berdasarkan kondisi dari trx
        $builder->join('trxTcm trx', 'trx.posisiId = s.id', 'left');
        $builder->join('tcm', 'tcm.id = trx.tcmId', 'left');  // Join dengan tcm untuk akses jenisId
        $builder->join('jenistcm', 'jenistcm.id = tcm.jenisId', 'left');  // Join dengan jenistcm untuk nama jenisTcm
        $builder->join('(' . $subquery->getCompiledSelect() . ') latest', 'trx.tcmId = latest.tcmId AND trx.updated_at = latest.latest_updated', 'inner');
        $builder->groupBy('s.jenis, jenistcm.nama');  // Group by jenis satkai dan jenisTcm
        return $builder->get()->getResultArray();
    }
}
