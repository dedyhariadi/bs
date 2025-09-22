<?php

namespace App\Models;

use CodeIgniter\Model;

class TrxTcmModel extends Model
{
    protected $table = 'trxTcm';
    protected $primaryKey = 'id';
    protected $allowedFields = ['kegiatanId', 'tcmId', 'posisiId', 'kondisi', 'created_at', 'updated_at'];
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




    /**
     * Get all TCM items at a specific location (only latest per tcmId)
     * @param string $lokasi
     * @return array
     */
    public function getItemsByLocation($lokasi)
    {
        // Query untuk ambil record terbaru per tcmId berdasarkan updated_at
        $subquery = $this->db->table($this->table)
            ->select('tcmId, MAX(updated_at) as latest_updated')
            ->groupBy('tcmId');

        return $this->select('trxTcm.*, tcm.serialNumber, tcm.status, tcm.partNumber, tcm.jenisId, satkai.satkai AS lokasi,tcm.id as tcmId')
            ->join('tcm', 'tcm.id = trxTcm.tcmId')
            ->join('satkai', 'satkai.id =   trxTcm.posisiId')
            ->join('(' . $subquery->getCompiledSelect() . ') as latest_trx', 'latest_trx.tcmId = trxTcm.tcmId AND latest_trx.latest_updated = trxTcm.updated_at')
            ->where('trxTcm.posisiId', $lokasi)
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

    /**
     * Update kondisi TCM berdasarkan trxTcm ID
     * @param int $trxId
     * @param string $kondisi
     * @return bool
     */
    public function updateKondisi($trxId, $kondisi)
    {
        return $this->update($trxId, ['kondisi' => $kondisi]);
    }

    /**
     * Get kondisi berdasarkan trxTcm ID
     * @param int $trxId
     * @return array|null
     */
    public function getKondisi($trxId)
    {
        return $this->select('kondisi')->find($trxId);
    }

    /**
     * Mengambil data TCM grouped by tcmId dengan tglPelaksanaan paling terakhir
     * @return array
     */
    public function getTcmGroupedByTcmIdWithLatestTgl()
    {
        // Subquery untuk ambil tglPelaksanaan terakhir per tcmId
        $subquery = $this->db->table('trxTcm')
            ->select('trxTcm.tcmId, MAX(kegiatan.tglPelaksanaan) as latest_tgl')
            ->join('kegiatan', 'kegiatan.id = trxTcm.kegiatanId')
            ->groupBy('trxTcm.tcmId');

        return $this->select('trxTcm.tcmId, tcm.serialNumber, tcm.partNumber, tcm.status, trxTcm.kondisi, satkai.satkai AS lokasi, satkai.id AS satkaiId, satkai.jenis AS jenisSatkai, jenistcm.nama AS jenisTCM, sub.latest_tgl')  // Tambah jenistcm.nama AS jenisTcmNama
            ->join('tcm', 'tcm.id = trxTcm.tcmId')
            ->join('jenistcm', 'jenistcm.id = tcm.jenisId', 'left')  // Tambah join dengan jenistcm
            ->join('satkai', 'satkai.id = trxTcm.posisiId', 'left')
            ->join('(' . $subquery->getCompiledSelect() . ') sub', 'sub.tcmId = trxTcm.tcmId', 'inner')
            ->where('kegiatan.tglPelaksanaan = sub.latest_tgl')  // Pastikan hanya ambil record dengan tgl terakhir
            ->join('kegiatan', 'kegiatan.id = trxTcm.kegiatanId')  // Join kegiatan untuk akses tglPelaksanaan
            ->groupBy('trxTcm.tcmId')  // Group by tcmId
            ->findAll();
    }

    /**
     * Count TCM items by location based on results from getTcmGroupedByTcmIdWithLatestTgl()
     * @return array Associative array with location as key and count as value
     */
    public function hitungTcmPerLokasi()
    {
        $results = $this->getTcmGroupedByTcmIdWithLatestTgl();
        $tcmCount = [];
        $lokasiMap = [];  // Untuk track lokasi yang sudah diproses
        foreach ($results as $item) {
            $lokasi = $item['lokasi'];
            if (!isset($lokasiMap[$lokasi])) {
                $lokasiMap[$lokasi] = count($tcmCount);  // Index integer
                $tcmCount[] = [
                    'tcmCount' => 0,
                    'satkai' => $item['lokasi'],
                    'posisiId' => $item['satkaiId'],
                    'jenisSatkai' => $item['jenisSatkai']
                ];
            }
            $index = $lokasiMap[$lokasi];
            $tcmCount[$index]['tcmCount']++;
        }
        return $tcmCount;
    }

    /**
     * Count TCM items by location based on results from getTcmGroupedByTcmIdWithLatestTgl()
     * @return array Associative array with location as key and array(count, satkaiId, jenisSatkai) as value
     */
    public function countTcmByLocation()
    {
        $results = $this->getTcmGroupedByTcmIdWithLatestTgl();
        $counts = [];
        foreach ($results as $item) {
            $lokasi = $item['lokasi'];
            if (!isset($counts[$lokasi])) {
                $counts[$lokasi] = [
                    'count' => 0,
                    'satkaiId' => $item['satkaiId'],
                    'jenisSatkai' => $item['jenisSatkai']
                ];
            }
            $counts[$lokasi]['count']++;
        }
        return $counts;
    }

    public function tcmByPosisi($transferId = null)
    {
        $groupedData = $this->getTcmGroupedByTcmIdWithLatestTgl();
        $byPosisi = [];

        foreach ($groupedData as $tcmId => $data) {
            $posisiId = $data['satkaiId'] ?? null;  // Gunakan satkaiId sebagai posisiId
            if ($posisiId && ($transferId === null || $posisiId == $transferId)) {  // Tambah where berdasarkan transferId
                if (!isset($byPosisi[$posisiId])) {
                    $byPosisi[$posisiId] = [];
                }
                $byPosisi[$posisiId][] = $data;
            }
        }

        return $byPosisi;
    }
}
