<?php

namespace App\Models;

use CodeIgniter\Model;

class KegiatanModel extends Model
{
    protected $table = 'kegiatan';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'jenisGiat',
        'suratId',
        'transferDariId',
        'transferKeId',
        'tglPelaksanaan',
        'keterangan',
        'created_at',
        'updated_at'
    ];
    protected $useTimestamps = true;
    protected $returnType = 'array';

    /**
     * Get kegiatan with details (surat, satkai)
     */
    public function getWithDetails($id = null)
    {
        $builder = $this->select('kegiatan.*, 
                                  surat.noSurat, surat.pejabat, surat.perihal,
                                  dari.satkai AS dari_satkai, ke.satkai AS ke_satkai')
            ->join('surat', 'surat.id = kegiatan.suratId', 'left')
            ->join('satkai AS dari', 'dari.id = kegiatan.transferDariId', 'left')
            ->join('satkai AS ke', 'ke.id = kegiatan.transferKeId', 'left');

        if ($id) {
            return $builder->where('kegiatan.id', $id)->first();
        }

        return $builder->findAll();
    }

    /**
     * Get kegiatan with TCM count
     */
    public function getWithTcmCount()
    {
        return $this->select('kegiatan.*, COUNT(trxTcm.id) AS countTcm')
            ->join('trxTcm', 'trxTcm.kegiatanId = kegiatan.id', 'left')
            ->groupBy('kegiatan.id')
            ->findAll();
    }

    /**
     * Get kegiatan by jenis
     */
    public function getByJenis($jenisGiat)
    {
        return $this->where('jenisGiat', $jenisGiat)->findAll();
    }
}
