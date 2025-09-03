<?php

namespace App\Models;

use CodeIgniter\Model;

class SuratModel extends Model
{
  protected $table = 'surat';
  protected $primaryKey = 'id';
  protected $allowedFields = ['noSurat', 'pejabat', 'perihal', 'tglSurat', 'filePdf', 'created_at', 'updated_at'];
  protected $useTimestamps = true;
  protected $returnType = 'array';

  /**
   * Get all surat
   * @return array
   */
  public function getAll()
  {
    return $this->findAll();
  }

  /**
   * Get surat by ID
   * @param int $id
   * @return array|null
   */
  public function getById($id)
  {
    return $this->find($id);
  }

  /**
   * Insert new surat
   * @param array $data
   * @return int|string
   */
  public function insertSurat($data)
  {
    return $this->insert($data);
  }

  /**
   * Update surat
   * @param int $id
   * @param array $data
   * @return bool
   */
  public function updateSurat($id, $data)
  {
    return $this->update($id, $data);
  }

  /**
   * Delete surat
   * @param int $id
   * @return bool
   */
  public function deleteSurat($id)
  {
    return $this->delete($id);
  }

  /**
   * Get surat by noSurat
   * @param string $noSurat
   * @return array|null
   */
  public function getByNoSurat($noSurat)
  {
    return $this->where('noSurat', $noSurat)->first();
  }
}
