<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KegiatanModel;
use App\Models\SuratModel;
use App\Models\SatkaiModel;
use App\Models\TcmModel;
use App\Models\TrxTcmModel;
use App\Models\JenisTcmModel;
use CodeIgniter\HTTP\ResponseInterface;

class KegiatanTcmController extends BaseController
{
    protected $kegiatanModel;
    protected $suratModel;
    protected $satkaiModel;
    protected $tcmModel;
    protected $trxTcmModel;
    protected $jenisTcmModel;

    public function __construct()
    {
        $this->kegiatanModel = new KegiatanModel();
        $this->suratModel = new SuratModel();
        $this->satkaiModel = new SatkaiModel();
        $this->tcmModel = new TcmModel();
        $this->trxTcmModel = new TrxTcmModel();
        $this->jenisTcmModel = new JenisTcmModel();
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

    public function store()
    {
        d($this->request->getPost(), $this->request->getMethod());
        // only allow POST
        if ($this->request->getMethod() !== 'POST') {
            return $this->response->setStatusCode(ResponseInterface::HTTP_METHOD_NOT_ALLOWED);
        }
        // ambil semua input dari form index.php kegiatan
        $data = [
            'jenisGiat' => $this->request->getPost('jenis'),
            'suratId' => $this->request->getPost('surat'),
            'transferDariId' => $this->request->getPost('transferDari'),
            'transferKeId' => $this->request->getPost('transferKe'),
            'tglPelaksanaan' => simpanTanggal($this->request->getPost('tglPelaksanaan')),
            'keterangan' => $this->request->getPost('keterangan'),
        ];

        // simpan menggunakan model
        $insertId = $this->kegiatanModel->insert($data);

        if ($insertId === false) {
            // jika validasi/model gagal, kembalikan beserta input dan error
            session()->setFlashdata('errors', $this->kegiatanModel->errors());
            return redirect()->back()->withInput();
        }

        session()->setFlashdata('success', 'Data kegiatan berhasil disimpan.');
        return redirect()->to('tcm/kegiatan');
    }

    public function update($id)
    {
        // hanya izinkan PUT
        if ($this->request->getMethod() !== 'PUT') {
            return $this->response->setStatusCode(ResponseInterface::HTTP_METHOD_NOT_ALLOWED);
        }

        // ambil semua input dari form index.php kegiatan
        $data = [
            'jenisGiat' => $this->request->getPost('jenis'),
            'suratId' => $this->request->getPost('surat'),
            'transferDariId' => $this->request->getPost('transferDari'),
            'transferKeId' => $this->request->getPost('transferKe'),
            'tglPelaksanaan' => simpanTanggal($this->request->getPost('tglPelaksanaan')),
            'keterangan' => $this->request->getPost('keterangan'),
        ];

        // update menggunakan model
        if (!$this->kegiatanModel->update($id, $data)) {
            // jika validasi/model gagal, kembalikan beserta input dan error
            session()->setFlashdata('errors', $this->kegiatanModel->errors());
            return redirect()->back()->withInput();
        }

        session()->setFlashdata('success', 'Data kegiatan berhasil diperbarui.');
        return redirect()->to('tcm/kegiatan');
    }

    public function delete($id)
    {
        // hanya izinkan DELETE
        if ($this->request->getMethod() !== 'DELETE') {
            return $this->response->setStatusCode(ResponseInterface::HTTP_METHOD_NOT_ALLOWED);
        }

        // hapus menggunakan model
        if (!$this->kegiatanModel->delete($id)) {
            session()->setFlashdata('errors', $this->kegiatanModel->errors());
            return redirect()->back();
        }

        session()->setFlashdata('success', 'Data kegiatan berhasil dihapus.');
        return redirect()->to('tcm/kegiatan');
    }

    public function show($id)
    {
        $kegiatan = $this->kegiatanModel->find($id);
        if (!$kegiatan) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Kegiatan tidak ditemukan');
        }

        $data = [
            'kegiatan' => $kegiatan,
            'satkai' => $this->satkaiModel->findAll(),
            'surat' => $this->suratModel->findAll(),
            'jenisTcm' => $this->jenisTcmModel->findAll(),
            'tcm' => $this->tcmModel->getTcmByKegiatanId($id)
        ];

        return view('tcm/kegiatan/detail', $data);
    }
}
