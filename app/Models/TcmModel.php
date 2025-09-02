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
        return $this->select('tcm.*, jenistcm.nama as jenis_nama')
            ->join('jenistcm', 'jenistcm.id = tcm.jenisId')
            ->where('tcm.jenisId', $jenisId)
            ->findAll();
    }
}
