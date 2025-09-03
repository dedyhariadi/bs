<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SuratModel;
use CodeIgniter\HTTP\ResponseInterface;

class SuratController extends BaseController
{

    protected $suratModel;

    public function __construct()
    {
        $this->suratModel = new SuratModel();
    }

    public function index()
    {

        return view('tcm/surat', [
            'surat' => $this->suratModel->findAll(),
        ]);
    }
}
