<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Jurnal as JurnalModel; // Import the Jurnal model

class Jurnal extends BaseController
{
    protected $Jurnalmodel;

    public function __construct()
    {
        $this->Jurnalmodel = new JurnalModel();
    }

    public function index()
    {
        // $model = new \App\Models\Jurnal();
        $data['jurnal'] = $this->Jurnalmodel->findAll();

        return view('jurnal/index', $data);
    }

    public function tambah()
    {
        $data = [
            'tanggal' => $this->request->getPost('tanggal'),
            'jenis' => 'harian',
            'kegiatan' => $this->request->getPost('kegiatan'),
            'foto' => $this->request->getPost('foto'),

        ];
        $this->Jurnalmodel->insert($data);

        // $data['jurnal'] = $this->Jurnalmodel->findAll();
        return redirect()->to('jurnal');
    }
}
