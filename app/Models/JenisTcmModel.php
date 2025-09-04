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
}
