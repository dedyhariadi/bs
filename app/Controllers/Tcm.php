<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Jenis as JenisModel;


class Tcm extends BaseController
{

    protected $jenisModel;

    public function __construct()
    {
        $this->jenisModel = new JenisModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Tcm',
            'jenis' => $this->jenisModel->findAll(),
        ];

        return view('tcm', $data);
    }
}
