<?php

namespace App\Models;

use CodeIgniter\Model;

class JenisTcmModel extends Model
{
  protected $table = 'jenistcm';
  protected $primaryKey = 'id';
  protected $allowedFields = ['nama', 'file'];
  protected $useTimestamps = true;
  protected $returnType = 'array';

  

  /**
   * Get jenis TCM by ID
   * @param int $id
   * @return array|null
   */
  public function getById($id)
  {
    return $this->find($id);
  }

  /**
   * Insert new jenis TCM
   * @param array $data
   * @return int|string
   */
  public function insertJenis($data)
  {
    return $this->insert($data);
  }

  /**
   * Update jenis TCM
   * @param int $id
   * @param array $data
   * @return bool
   */
  public function updateJenis($id, $data)
  {
    return $this->update($id, $data);
  }

  /**
   * Delete jenis TCM
   * @param int $id
   * @return bool
   */
  public function deleteJenis($id)
  {
    return $this->delete($id);
  }

  /**
   * Get jenis TCM with file info
   * @return array
   */
  public function getWithFiles()
  {
    return $this->where('file IS NOT NULL')->findAll();
  }
}
