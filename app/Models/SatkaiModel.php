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
    foreach ($data as &$row) {
      $row['tcmIds'] = $row['tcmIds'] ? explode(',', $row['tcmIds']) : [];
    }

    // Kumpulkan semua tcmIds unik
    $allTcmIds = [];
    foreach ($data as $row) {
      $allTcmIds = array_merge($allTcmIds, $row['tcmIds']);
    }

    $allTcmIds = array_unique($allTcmIds);


    $tcmDetails = [];
    if (!empty($allTcmIds)) {
      $tcmDetailsQuery = $this->db->table('tcm')
        ->select('id, jenisId, partNumber, serialNumber')
        ->whereIn('id', $allTcmIds)
        ->get()
        ->getResultArray();

      // Index by id
      foreach ($tcmDetailsQuery as $detail) {
        $tcmDetails[$detail['id']] = $detail;
      }
    }

    // Replace tcmIds dengan details
    foreach ($data as &$row) {
      $row['tcmDetails'] = [];
      foreach ($row['tcmIds'] as $tcmId) {
        if (isset($tcmDetails[$tcmId])) {
          $row['tcmDetails'][] = [
            'jenisTCM' => $tcmDetails[$tcmId]['jenisId'],
            'partNumber' => $tcmDetails[$tcmId]['partNumber'],
            'serialNumber' => $tcmDetails[$tcmId]['serialNumber'],
          ];
        }
      }
      unset($row['tcmIds']);
    }
    return $data;
  }
}
