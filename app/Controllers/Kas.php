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

        if ($this->request->getPost()) {
            $this->kasModel->insert([
                'tanggal' => simpanTanggal($this->request->getPost('tanggal')),
                'keterangan' => $this->request->getPost('uraian'),
                'pemasukan' => $this->request->getPost('jenisTransaksi') === 'pemasukan' ? preg_replace('/[^\d]/', '', $this->request->getPost('jumlah')) : 0,
                'pengeluaran' => $this->request->getPost('jenisTransaksi') === 'pengeluaran' ? preg_replace('/[^\d]/', '', $this->request->getPost('jumlah')) : 0,
            ]);
            session()->setFlashdata('success', 'Transaksi berhasil ditambahkan.');
        }
        $data = [
            'title' => 'Kas',
            'kas' => $this->kasModel->orderBy('tanggal', 'ASC')->findAll(),
            'masukan' => $this->request->getVar(),
        ];

        return view('kas', $data);
    }

    public function hapus($id)
    {
        $this->kasModel->delete($id);
        return redirect()->to('/kas')->with('success', 'Transaksi berhasil dihapus.');
    }

    public function edit($id)
    {
        $kas = $this->kasModel->find($id);

        if ($this->request->getPost()) {

            if ($this->kasModel->update($id, [
                'tanggal' => simpanTanggal($this->request->getPost('tanggal')),
                'keterangan' => $this->request->getPost('uraian'),
                'pemasukan' => $this->request->getPost('jenisTransaksi') === 'pemasukan' ? preg_replace('/[^\d]/', '', $this->request->getPost('jumlah')) : 0,
                'pengeluaran' => $this->request->getPost('jenisTransaksi') === 'pengeluaran' ? preg_replace('/[^\d]/', '', $this->request->getPost('jumlah')) : 0,
            ])) {
                return redirect()->to('/kas')->with('success', 'Transaksi berhasil diubah.');
            } else {
                dd($this->kasModel->errors());
            }
        }

        $data = [
            'title' => 'Edit Kas',
            'kas' => $kas,
        ];

        return view('kas', $data);
    }
}
