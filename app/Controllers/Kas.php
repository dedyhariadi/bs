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

        if ($this->request->getvar()) {
            $this->kasModel->insert([
                'tanggal' => $this->request->getVar('tanggal'),
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

    public function hapus($id)
    {
        $this->kasModel->delete($id);
        session()->setFlashdata('pesan', 'Transaksi berhasil dihapus.');
        return redirect()->to('/kas');
    }

    public function edit($id)
    {
        $kas = $this->kasModel->find($id);

        if ($this->request->getVar()) {
            $this->kasModel->update($id, [
                'tanggal' => $this->request->getVar('tanggal'),
                'keterangan' => $this->request->getVar('uraian'),
                'pemasukan' => $this->request->getVar('jenisTransaksi') === 'pemasukan' ? $this->request->getVar('jumlah') : 0,
                'pengeluaran' => $this->request->getVar('jenisTransaksi') === 'pengeluaran' ? $this->request->getVar('jumlah') : 0,
            ]);
            session()->setFlashdata('pesan', 'Transaksi berhasil diubah.');
            return redirect()->to('/kas');
        }

        $data = [
            'title' => 'Edit Kas',
            'kas' => $kas,
        ];

        return view('kas', $data);
    }
}
