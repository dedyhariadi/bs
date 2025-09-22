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
}
