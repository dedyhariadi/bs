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
            'jenisTcmCount' => $this->trxTcmModel->getJenisTcmCounts(),
            'getTcmWithLatestTrx' => $this->trxTcmModel->getTcmGroupedByTcmIdWithLatestTgl(),
        ];

        return view('tcm//rekap/index', $data);
    }

    /**
     * Store kegiatan baru dan update posisi TCM
     */
    public function store()
    {
        // hanya izinkan POST
        if ($this->request->getMethod() !== 'POST') {
            return $this->response->setStatusCode(405, 'Method Not Allowed');
        }

        $kegiatanId = $this->request->getPost('kegiatanId');

        if ($this->request->getVar('jenisGiat') == 'barangMasuk') {
            // kegiatan barang masuk
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
                'kegiatanId' => $kegiatanId,
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
        } else {
            $selectedIds = $this->request->getPost('pilih'); // Array id yang dipilih
            $jenisGiat = $this->request->getPost('jenisGiat');
            $posisiId = $this->request->getPost('posisiId');


            if ($jenisGiat == 'nonBarangMasuk' && is_array($selectedIds)) {
                foreach ($selectedIds as $tcmId) {
                    // Ambil kondisi untuk tcmId ini
                    // Check if tcmId is already associated with this kegiatanId
                    $existing = $this->trxTcmModel->where('tcmId', $tcmId)->where('kegiatanId', $kegiatanId)->first();
                    if ($existing) {
                        session()->setFlashdata('error', 'Data TCM sudah ada.');
                        return redirect()->to('tcm/kegiatan/' . $kegiatanId);
                    }
                    $kondisi = $this->request->getPost('kondisi' . $tcmId) ?? 'OK';

                    // Insert ke trxTcm
                    $dataTrx = [
                        'tcmId' => $tcmId,
                        'kegiatanId' => $kegiatanId,
                        'posisiId' => $posisiId,
                        'kondisi' => $kondisi,
                    ];
                    $this->trxTcmModel->insert($dataTrx);
                }
                session()->setFlashdata('success', 'Data TCM berhasil disimpan.');
            }
        }
        // dd($this->request->getVar(), $dataTrx);
        return redirect()->to('tcm/kegiatan/' . $kegiatanId);
    }

    /**
     * Delete TCM by ID
     */
    public function delete($id)
    {

        // dd($this->request->getVar());
        // hanya izinkan DELETE
        if ($this->request->getMethod() !== 'DELETE') {
            return $this->response->setStatusCode(405, 'Method Not Allowed');
        }

        // cari TCM berdasarkan ID
        $tcm = $this->tcmModel->find($id);
        if (!$tcm) {
            return $this->response->setStatusCode(404, 'TCM not found');
        }


        // jika barang masuk
        if ($this->request->getVar('jenisGiat') === 'barangMasuk') {
            // hapus TCM
            if (!$this->tcmModel->delete($id)) {
                return $this->response->setStatusCode(500, 'Failed to delete TCM');
            }
        }


        //hapus untuk nonBarangMasuk list dulu daftar trxtcm yang sebelum tglpelaksanaan
        if ($this->request->getVar('jenisGiat') === 'nonBarangMasuk') {
            $this->trxTcmModel->where('tcmId', $id)
                ->where('tglPelaksanaan <', $tcm['tglPelaksanaan'])
                ->delete();
        }

        // hapus TCM di trxtcm
        if (!$this->trxTcmModel->delete($this->request->getVar('trxtcmId'))) {
            return $this->response->setStatusCode(500, 'Failed to delete TCM di trxtcm');
        }

        session()->setFlashdata('success', 'SN ' . $tcm['serialNumber'] . ' berhasil dihapus.');
        return redirect()->to('tcm/kegiatan/' . $this->request->getPost('kegiatanId'));
    }
}
