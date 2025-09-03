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
     * Form untuk create kegiatan baru
     */
    public function create()
    {
        // Ambil data untuk dropdown
        $data['tcmList'] = $this->tcmModel->getAllWithJenis();
        $data['jenisList'] = $this->jenisTcmModel->getAll();
        $data['satkaiList'] = $this->getSatkaiList(); // Asumsikan ada model SatkaiModel, atau query manual

        return view('tcm/create', $data);
    }

    /**
     * Store kegiatan baru dan update posisi TCM
     */
    public function store()
    {
        $rules = [
            'jenisGiat' => 'required',
            'suratId' => 'required|integer',
            'transferDariId' => 'required|integer',
            'transferKeId' => 'required|integer',
            'tcmIds' => 'required', // Array of TCM IDs
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Insert kegiatan
        $kegiatanData = [
            'jenisGiat' => $this->request->getPost('jenisGiat'),
            'suratId' => $this->request->getPost('suratId'),
            'transferDariId' => $this->request->getPost('transferDariId'),
            'transferKeId' => $this->request->getPost('transferKeId'),
            'tglPelaksanaan' => $this->request->getPost('tglPelaksanaan'),
            'keterangan' => $this->request->getPost('keterangan'),
        ];

        // Asumsikan ada KegiatanModel untuk insert
        $kegiatanId = $this->kegiatanModel->insert($kegiatanData);

        if (!$kegiatanId) {
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan kegiatan');
        }

        // Insert trxTcm untuk setiap TCM
        $tcmIds = $this->request->getPost('tcmIds');
        foreach ($tcmIds as $tcmId) {
            $trxData = [
                'kegiatanId' => $kegiatanId,
                'tcmId' => $tcmId,
                'posisiId' => $kegiatanData['transferKeId'],
            ];
            $this->trxTcmModel->insert($trxData);
        }

        return redirect()->to('/tcm-dashboard')->with('success', 'Kegiatan berhasil ditambahkan');
    }

    /**
     * Helper: Get satkai list
     */
    private function getSatkaiList()
    {
        return $this->satkaiModel->getAll();
    }

    /**
     * Edit kegiatan
     */
    public function edit($id)
    {
        $data['kegiatan'] = $this->kegiatanModel->getWithDetails($id);
        $data['tcmList'] = $this->tcmModel->getAllWithJenis();
        $data['jenisList'] = $this->jenisTcmModel->getAll();
        $data['satkaiList'] = $this->getSatkaiList();

        if (!$data['kegiatan']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Kegiatan tidak ditemukan');
        }

        return view('tcm/edit', $data);
    }

    /**
     * Update kegiatan
     */
    public function update($id)
    {
        $rules = [
            'jenisGiat' => 'required',
            'suratId' => 'required|integer',
            'transferDariId' => 'required|integer',
            'transferKeId' => 'required|integer',
            'tcmIds' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $kegiatanData = [
            'jenisGiat' => $this->request->getPost('jenisGiat'),
            'suratId' => $this->request->getPost('suratId'),
            'transferDariId' => $this->request->getPost('transferDariId'),
            'transferKeId' => $this->request->getPost('transferKeId'),
            'tglPelaksanaan' => $this->request->getPost('tglPelaksanaan'),
            'keterangan' => $this->request->getPost('keterangan'),
        ];

        $this->kegiatanModel->update($id, $kegiatanData);

        // Delete trxTcm lama untuk kegiatan ini
        $this->trxTcmModel->where('kegiatanId', $id)->delete();

        // Insert trxTcm baru berdasarkan tcmIds yang dipilih
        $tcmIds = $this->request->getPost('tcmIds');
        foreach ($tcmIds as $tcmId) {
            $trxData = [
                'kegiatanId' => $id,
                'tcmId' => $tcmId,
                'posisiId' => $kegiatanData['transferKeId'],
            ];
            $this->trxTcmModel->insert($trxData);
        }

        return redirect()->to('/tcm-dashboard')->with('success', 'Kegiatan berhasil diupdate');
    }

    /**
     * Delete kegiatan
     */
    public function delete($id)
    {
        $this->kegiatanModel->delete($id);
        return redirect()->to('/tcm-dashboard')->with('success', 'Kegiatan berhasil dihapus');
    }
}
