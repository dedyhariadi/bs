<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KegiatanModel;
use CodeIgniter\HTTP\ResponseInterface;

class KegiatanTcmController extends BaseController
{
    protected $kegiatanModel;

    public function __construct()
    {
        $this->kegiatanModel = new KegiatanModel();
    }

    public function index()
    {
        $data['kegiatan'] = $this->kegiatanModel->getWithTcmCount();

        return view('tcm/kegiatan/index', $data);
    }
}
