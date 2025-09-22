<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SatkaiModel;
use App\Models\JenisTcmModel;
use App\Models\TrxTcmModel;
use CodeIgniter\HTTP\ResponseInterface;

class SatkaiController extends BaseController
{
    protected $satkaiModel;
    protected $jenisTcmModel;
    protected $trxTcmModel;

    public function __construct()
    {
        $this->satkaiModel = new SatkaiModel();
        $this->jenisTcmModel = new JenisTcmModel();
        $this->trxTcmModel = new TrxTcmModel();
    }

    public function index()
    {
        $data = [
            'satkai' => $this->satkaiModel->findAll(),
            'getTcmGroupedByTcmIdWithLatestTgl' => $this->trxTcmModel->getTcmGroupedByTcmIdWithLatestTgl(),
            'listTcmBySatkai' => $this->trxTcmModel->hitungTcmPerLokasi()
        ];
        return view('tcm/satkai', $data);
    }
    public function store(): ResponseInterface
    {

        try {
            $insertId = $this->satkaiModel->insert([
                'satkai' => $this->request->getPost('nama'),
                'jenis' => $this->request->getPost('jenis'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
            if ($insertId === false) {
                throw new \RuntimeException('Gagal menyimpan data.');
            }

            session()->setFlashdata('success', 'Data satkai berhasil disimpan.');
            return redirect()->to('tcm/satkai');
        } catch (\Throwable $e) {
            session()->setFlashdata('error', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function update($id): ResponseInterface
    {
        try {
            $existing = $this->satkaiModel->find($id);
            if (!$existing) {
                throw new \RuntimeException('Data tidak ditemukan.');
            }

            $data = [
                'satkai'     => $this->request->getPost('nama'),
                'jenis'      => $this->request->getPost('jenis'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];

            $result = $this->satkaiModel->update($id, $data);
            if ($result === false) {
                $errors = method_exists($this->satkaiModel, 'errors') ? (array) $this->satkaiModel->errors() : [];
                $message = $errors ? implode(' ', $errors) : 'Gagal memperbarui data.';
                throw new \RuntimeException($message);
            }

            session()->setFlashdata('success', 'Data satkai berhasil diperbarui.');
            return redirect()->to('tcm/satkai');
        } catch (\Throwable $e) {
            session()->setFlashdata('error', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }


    public function delete($id): ResponseInterface
    {
        try {
            $existing = $this->satkaiModel->find($id);
            if (!$existing) {
                throw new \RuntimeException('Data tidak ditemukan.');
            }

            $result = $this->satkaiModel->delete($id);
            if ($result === false) {
                $errors = method_exists($this->satkaiModel, 'errors') ? (array) $this->satkaiModel->errors() : [];
                $message = $errors ? implode(' ', $errors) : 'Gagal menghapus data.';
                throw new \RuntimeException($message);
            }

            session()->setFlashdata('success', $existing['satkai'] . ' berhasil dihapus.');
            return redirect()->to('tcm/satkai');
        } catch (\Throwable $e) {
            session()->setFlashdata('error', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }
}
