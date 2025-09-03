<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KegiatanModel;
use App\Models\SuratModel;
use App\Models\SatkaiModel;
use CodeIgniter\HTTP\ResponseInterface;

class KegiatanTcmController extends BaseController
{
    protected $kegiatanModel;
    protected $suratModel;
    protected $satkaiModel;

    public function __construct()
    {
        $this->kegiatanModel = new KegiatanModel();
        $this->suratModel = new SuratModel();
        $this->satkaiModel = new SatkaiModel();
    }

    public function index()
    {
        $data = [
            'kegiatan' => $this->kegiatanModel->getWithTcmCount(),
            'surat' => $this->suratModel->findAll(),
            'satkai' => $this->satkaiModel->findAll(),
        ];

        return view('tcm/kegiatan/index', $data);
    }
}
