<?php

namespace App\Controllers;


use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Kas as KasModel;

class Kas extends BaseController
{

    protected $kasModel;

    public function __construct()
    {
        $this->kasModel = new KasModel();
    }

    public function index()
    {
        //
        // echo "ini halaman kas";
        if ($this->request->getvar()) {
            $this->kasModel->insert([
                'tanggal' => date('Y-m-d'),
                'keterangan' => $this->request->getVar('uraian'),
                'pemasukan' => $this->request->getVar('jenisTransaksi') === 'pemasukan' ? $this->request->getVar('jumlah') : 0,
                'pengeluaran' => $this->request->getVar('jenisTransaksi') === 'pengeluaran' ? $this->request->getVar('jumlah') : 0,
            ]);
        }
        $data = [
            'title' => 'Kas',
            'kas' => $this->kasModel->findAll(),
            'masukan' => $this->request->getVar(),
        ];

        return view('kas', $data);
    }
}
