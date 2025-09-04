<?php

namespace App\Controllers;

use App\Models\TcmModel;
use App\Models\TrxTcmModel;
use App\Models\KegiatanModel;
use App\Models\JenisTcmModel;
use App\Models\SatkaiModel;
use App\Models\SuratModel;
use CodeIgniter\Controller;

class TcmController extends BaseController
{
    protected $tcmModel;
    protected $trxTcmModel;
    protected $kegiatanModel;
    protected $jenisTcmModel;
    protected $satkaiModel;
    protected $suratModel;

    public function __construct()
    {
        $this->tcmModel = new TcmModel();
        $this->trxTcmModel = new TrxTcmModel();
        $this->kegiatanModel = new KegiatanModel();
        $this->jenisTcmModel = new JenisTcmModel();
        $this->satkaiModel = new SatkaiModel();
        $this->suratModel = new SuratModel();
    }

    /**
     * Index: Tampilkan daftar kegiatan dan rekapitulasi TCM
     */
    public function index()
    {

        $data['kegiatan'] = $this->kegiatanModel->getWithTcmCount();

        // 
        $data['rekapTcm'] = $this->trxTcmModel->getAllWithDetails();

        $data = [
            'rekapTcm' => $this->trxTcmModel->getAllWithDetails(), //Data untuk rekapitulasi TCM dengan posisi 
            'kegiatan' => $this->kegiatanModel->getWithTcmCount(), // Data untuk daftar kegiatan dengan jumlah TCM
            'jenisTcm' => $this->jenisTcmModel->findAll(),
        ];


        return view('tcm//rekap/index', $data);
    }

    /**
     * Store kegiatan baru dan update posisi TCM
     */
    public function store()
    {


        $data = [
            'jenisId' => $this->request->getPost('jenisTcm'),
            'status' => 'AKTIF',
            'partNumber' => $this->request->getPost('partNumber'),
            'serialNumber' => $this->request->getPost('serialNumber'),
        ];

        $kondisi = $this->request->getPost('kondisi');

        // simpan menggunakan model
        $insertId = $this->tcmModel->insert($data);

        if ($insertId === false) {
            // jika validasi/model gagal, kembalikan beserta input dan error
            session()->setFlashdata('errors', $this->tcmModel->errors());
            return redirect()->back()->withInput();
        }
        $datatrxTcm = [
            'tcmId' => $insertId,
            'kegiatanId' => $this->request->getPost('kegiatanId'),
            'posisiId' => $this->request->getPost('posisiId'),
            'kondisi' => $kondisi,
        ];

        $insertId = $this->trxTcmModel->insert($datatrxTcm);

        if ($insertId === false) {
            // jika validasi/model gagal, kembalikan beserta input dan error
            session()->setFlashdata('errors', $this->trxTcmModel->errors());
            return redirect()->back()->withInput();
        }

        session()->setFlashdata('success', 'Data TCM berhasil disimpan.');
        return redirect()->to('tcm/kegiatan/' . $this->request->getPost('kegiatanId'));


        // dd($this->request->getPost(), $this->request->getMethod());
        // Update posisi TCM pada TcmModel jika diperlukan
        // if ($posisi) {
        //     $this->tcmModel->updatePosisi($kegiatanId, $posisi);
        // }

    }
}
