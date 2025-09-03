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
   * Get all satkai
   * @return array
   */
  public function getAll()
  {
    return $this->findAll();
  }

  /**
   * Get satkai by ID
   * @param int $id
   * @return array|null
   */
  public function getById($id)
  {
    return $this->find($id);
  }

  /**
   * Insert new satkai
   * @param array $data
   * @return int|string
   */
  public function insertSatkai($data)
  {
    return $this->insert($data);
  }

  /**
   * Update satkai
   * @param int $id
   * @param array $data
   * @return bool
   */


  public function updateSatkai($id, $data)
  {
    return $this->update($id, $data);
  }

  /**
   * Delete satkai
   * @param int $id
   * @return bool
   */
  public function deleteSatkai($id)
  {
    return $this->delete($id);
  }

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
    $builder = $this->db->table($this->table . ' s');
    $builder->select('s.id AS id, s.satkai, s.jenis, COUNT(trx.id) AS tcmCount');
    $builder->join('trxTcm trx', 'trx.posisiId = s.id', 'left');
    $builder->groupBy('s.id, s.satkai, s.jenis');
    return $builder->get()->getResultArray();
  }
}
