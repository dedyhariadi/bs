<?php

namespace App\Models;

use CodeIgniter\Model;

class SatkaiModel extends Model
{
  protected $table = 'satkai';
  protected $primaryKey = 'id';
  protected $allowedFields = ['satkai', 'jenis', 'created_at', 'updated_at'];
  protected $useTimestamps = true;
  protected $returnType = 'array';


  /**
   * Get satkai by jenis
   * @param string $jenis
   * @return array
   */
  public function getByJenis($jenis)
  {
    return $this->where('jenis', $jenis)->findAll();
  }

  /**
   * Menghasilkan jumlah TCM di tiap satkai
   * @return array
   */
  public function getTcmCountsPerSatkai()
  {


    $subquery = $this->db->table('trxTcm')
      ->select('tcmId, MAX(updated_at) as latest_updated, kondisi')
      ->groupBy('tcmId');

    $builder = $this->db->table($this->table . ' s');
    $builder->select('s.id AS id, s.satkai, s.jenis, COUNT(DISTINCT trx.tcmId) AS tcmCount, GROUP_CONCAT(DISTINCT trx.tcmId) AS tcmIds, trx.posisiId as posisiId');  // Tambah GROUP_CONCAT untuk daftar tcmId
    $builder->join('trxTcm trx', 'trx.posisiId = s.id', 'left');
    $builder->join('(' . $subquery->getCompiledSelect() . ') latest', 'trx.tcmId = latest.tcmId AND trx.updated_at = latest.latest_updated', 'inner');
    $builder->groupBy('s.id, s.satkai, s.jenis');
    return $builder->get()->getResultArray();
    return $results;
  }




  /**
   * Menghasilkan jumlah TCM di tiap satkai beserta details TCM
   * @return array
   */
  public function getTcmCountsWithDetails()
  {
    $data = $this->getTcmCountsPerSatkai();  // Panggil method existing

    // Pisahkan tcmIds menjadi array
    $allTcmIds = [];
    foreach ($data as &$row) {
      $row['tcmIds'] = $row['tcmIds'] ? explode(',', $row['tcmIds']) : [];
      $allTcmIds = array_merge($allTcmIds, $row['tcmIds']);
    }
    $allTcmIds = array_unique($allTcmIds);

    // Fetch details for all tcmIds dengan join jenisTcm
    $tcmDetails = [];
    if (!empty($allTcmIds)) {
      $tcmDetailsQuery = $this->db->table('tcm')
        ->select('tcm.id, jenisTcm.nama AS jenisTCM, tcm.partNumber, tcm.serialNumber, tcm.status AS kondisi')
        ->join('jenistcm', 'jenistcm.id = tcm.jenisId', 'left')
        ->whereIn('tcm.id', $allTcmIds)
        ->get()
        ->getResultArray();

      // Index by id
      foreach ($tcmDetailsQuery as $detail) {
        $tcmDetails[$detail['id']] = $detail;
      }
    }

    // Fetch kondisi dan id dari trxTcm berdasarkan max(updated_at) per tcmId
    $tcmKondisi = [];
    if (!empty($allTcmIds)) {
      // Subquery untuk ambil id record dengan updated_at terbaru per tcmId
      $subquery = $this->db->table('trxTcm')
        ->select('tcmId, MAX(updated_at) as latest_updated')
        ->whereIn('tcmId', $allTcmIds)
        ->groupBy('tcmId');

      // Query utama untuk ambil kondisi dan id berdasarkan subquery
      $tcmKondisiQuery = $this->db->table('trxTcm trx')
        ->select('trx.tcmId, trx.kondisi, trx.id, latest.tcmId')
        ->join('(' . $subquery->getCompiledSelect() . ') latest', 'trx.tcmId = latest.tcmId AND trx.updated_at = latest.latest_updated', 'inner')
        ->whereIn('trx.tcmId', $allTcmIds)
        ->get()
        ->getResultArray();

      // Index by tcmId
      foreach ($tcmKondisiQuery as $kondisi) {
        $tcmKondisi[$kondisi['tcmId']] = $kondisi;
      }
    }

    // Replace tcmIds dengan details, termasuk kondisi dari trxTcm
    foreach ($data as &$row) {
      $row['tcmDetails'] = [];
      foreach ($row['tcmIds'] as $tcmId) {
        if (isset($tcmDetails[$tcmId])) {
          $row['tcmDetails'][] = [
            'jenisTCM' => $tcmDetails[$tcmId]['jenisTCM'],
            'partNumber' => $tcmDetails[$tcmId]['partNumber'],
            'serialNumber' => $tcmDetails[$tcmId]['serialNumber'],
            'kondisi' => isset($tcmKondisi[$tcmId]) ? $tcmKondisi[$tcmId]['kondisi'] : $tcmDetails[$tcmId]['kondisi'],  // Prioritas kondisi dari trxTcm
            'trxId' => isset($tcmKondisi[$tcmId]) ? $tcmKondisi[$tcmId]['id'] : null,  // Tambah trxId jika perlu
            'tcmId' => $tcmId
          ];
        }
      }
      unset($row['tcmIds']);
    }

    return $data;
  }
}
