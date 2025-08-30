<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Jenis as JenisModel;
use App\Models\Satkai as SatkaiModel; // Uncomment if you need to use SatkaiModel
use App\Models\Tcm as TcmModel; // Uncomment if you need to use TcmModel
use App\Models\Surat as SuratModel; // Uncomment if you need to use SuratModel
use App\Models\TrxTcm as TrxTcmModel;
use App\Models\Kegiatan as KegiatanModel; // Uncomment if you need to use KegiatanModel




class Tcm extends BaseController
{

    protected $jenisModel;
    protected $satkaiModel;
    protected $tcmModel;
    protected $suratModel;
    protected $trxTcmModel;
    protected $kegiatanModel; // Uncomment if you need to use KegiatanModel


    public function __construct()
    {
        $this->jenisModel = new JenisModel();
        $this->satkaiModel = new SatkaiModel();
        $this->tcmModel = new TcmModel();
        $this->suratModel = new SuratModel(); // Initialize SuratModel if needed
        $this->trxTcmModel = new TrxTcmModel();
        $this->kegiatanModel = new KegiatanModel(); // Initialize KegiatanModel if needed
    }

    public function index()
    {

        $data = [
            'title' => 'Tcm',
            'jenis' => $this->jenisModel->findAll(),
            'satkai' => $this->satkaiModel->findAll(), // Fetch all positions
            'tcm' => $this->tcmModel->findAll(), // Fetch all TCMs
            'surat' => $this->suratModel->findAll(), // Fetch all surat records if needed
            'trxTcm' => $this->trxTcmModel->findAll(),
            'kegiatan' => $this->kegiatanModel->findAll(), // Fetch all kegiatan records if needed

        ];
        // dd($data);
        return view('tcm/index', $data);
    }

    public function detail($id)
    {
        $data = [
            'title' => 'Detail Tcm',
            'jenis' => $this->jenisModel->find($id),
            'satkai' => $this->satkaiModel->findAll(), // Fetch all positions
            'tcmList' => $this->tcmModel->where('jenisId', $id)->findAll(), // Fetch TCMs by jenisId
            'jenisId' => $id, // Pass the jenisId to the view
        ];

        return view('tcm/detail', $data);
    }

    public function tambah()
    {
        $data = [
            'jenisId' => $this->request->getPost('jenisId'),
            'status' => $this->request->getPost('status'),
            'partNumber' => $this->request->getPost('partnumber'),
            'serialNumber' => $this->request->getPost('serialnumber'),
        ];

        $this->tcmModel->insert($data);
        return redirect()->to('tcm/detail/' . $data['jenisId']);
    }

    public function hapus($id)
    {
        // dd($id);
        $tcm = $this->tcmModel->find($id);
        if ($tcm) {
            $this->tcmModel->delete($id);
            return redirect()->to('tcm/detail/' . $tcm['jenisId']);
        } else {
            return redirect()->back()->with('error', 'TCM not found');
        }
    }

    public function edit($id)
    {
        $tcm = $this->tcmModel->find($id);
        if (!$tcm) {
            return redirect()->back()->with('error', 'TCM not found');
        }

        $jenisId = $this->request->getPost('jenisId');
        $data = [
            'id' => $id,
            'jenisId' => $jenisId,
            'status' => $this->request->getPost('status'),
            'partNumber' => $this->request->getPost('partnumber'),
            'serialNumber' => $this->request->getPost('serialnumber'),
        ];

        // Update the TCM data
        $this->tcmModel->update($id, $data);
        return redirect()->to('tcm/detail/' . $data['jenisId']);
        // return redirect('tcm/detail/' . $jenisId, $data);
    }

    public function surat()
    {
        $data = [
            'title' => 'Surat Index',
            'jenis' => $this->jenisModel->findAll(),
            'satkai' => $this->satkaiModel->findAll(), // Fetch all positions
            'tcm' => $this->tcmModel->findAll(), // Fetch all TCMs
            'surat' => $this->suratModel->findAll(),
            'trxTcm' => $this->trxTcmModel->findAll()
        ];

        return view('tcm/surat', $data);
    }

    public function tambahSurat()
    {

        $data = [
            'noSurat' => $this->request->getPost('noSurat'),
            'pejabat' => $this->request->getPost('pejabat'),
            'perihal' => $this->request->getPost('perihal'),
            'tglSurat' => simpanTanggal($this->request->getPost('tglSurat')),
        ];
        // Insert the surat data into the database
        $this->suratModel->insert($data);
        $prevPage = 'surat';
        // Redirect to the surat index page or wherever you want
        return redirect()->to('tcm/surat')->with('success', 'Berhasil menambahkan surat.');

        // return view('tcm/suratDetail', $data);
    }

    public function hapusSurat($id)
    {
        $surat = $this->suratModel->find($id);
        if ($surat) {
            $this->suratModel->delete($id);
            return redirect()->to('tcm/surat')->with('hapus', 'Berhasil menghapus surat.');
        } else {
            return redirect()->back()->with('error', 'Surat not found');
        }
    }

    public function editSurat($id)
    {
        $surat = $this->suratModel->find($id);
        if (!$surat) {
            return redirect()->back()->with('error', 'Surat not found');
        }

        $data = [
            'noSurat' => $this->request->getPost('noSurat'),
            'pejabat' => $this->request->getPost('pejabat'),
            'perihal' => $this->request->getPost('perihal'),
            'tglSurat' => simpanTanggal($this->request->getPost('tglSurat')),
        ];

        $this->suratModel->update($id, $data);
        return redirect()->to('tcm/surat')->with('success', 'Surat updated successfully');
    }

    public function tambahKegiatan()
    {

        $data = [
            'jenisGiat' => $this->request->getPost('jenis'),
            'suratId' => $this->request->getPost('noSurat'),
            'transferDariId' => $this->request->getPost('transferDariId'),
            'transferKeId' => $this->request->getPost('transferKeId'),
            'tglPelaksanaan' => $this->request->getPost('tglPelaksanaan') ? simpanTanggal($this->request->getPost('tglPelaksanaan')) : null,
            'keterangan' => $this->request->getPost('keterangan'),
        ];

        // Insert the activity data into the database
        if ($this->kegiatanModel->save($data)) {
            session()->setFlashdata('success', 'Berhasil menambahkan kegiatan.');
        } else {
            session()->setFlashdata('error', 'Gagal menambahkan kegiatan.');
        }

        // Redirect to a relevant page, e.g., detail TCM
        return redirect()->to('tcm');
    }

    public function editKegiatan($id)
    {
        $kegiatan = $this->kegiatanModel->find($id);
        if (!$kegiatan) {
            return redirect()->back()->with('error', 'Kegiatan not found');
        }

        $data = [
            'jenisGiat' => $this->request->getPost('jenis'),
            'suratId' => $this->request->getPost('noSurat'),
            'transferDariId' => $this->request->getPost('transferDariId'),
            'transferKeId' => $this->request->getPost('transferKeId'),
            'tglPelaksanaan' => $this->request->getPost('tglPelaksanaan') ? simpanTanggal($this->request->getPost('tglPelaksanaan')) : null,
            'keterangan' => $this->request->getPost('keterangan'),
        ];

        // Update the activity data
        if (!$this->kegiatanModel->update($id, $data)) {
            return redirect()->back()->with('error', 'Gagal memperbarui kegiatan.');
        }
        // $this->kegiatanModel->update($id, $data);
        return redirect()->to('tcm')->with('success', 'Kegiatan berhasil diperbarui.');
    }

    public function hapusKegiatan($id)
    {
        $kegiatan = $this->kegiatanModel->find($id);
        if ($kegiatan) {
            $this->kegiatanModel->delete($id);
            return redirect()->to('tcm')->with('hapus', 'Kegiatan berhasil dihapus.');
        } else {
            session()->setFlashdata('error', 'Kegiatan not found.');
            return redirect()->back()->with('error', 'Kegiatan not found');
        }
    }

    public function trxtcm($idKegiatan)
    {
        if ($this->request->getVar('tcmId')) {
            // dd($this->request->getVar());
            $dataTrx = [
                'kegiatanId' => $idKegiatan,
                'tcmId' => $this->request->getVar('tcmId'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
            // Insert the transaction data into the database
            $this->trxTcmModel->insert($dataTrx);
            session()->setFlashdata('success', 'Berhasil menambahkan transaksi TCM.');
        }

        $selectedTransferKeId = $this->kegiatanModel->select('kegiatan.transferKeId')->orderBy('kegiatan.updated_at')->first();

        $data = [
            'title' => 'Trx TCM',
            'jenis' => $this->jenisModel->findAll(),
            'satkai' => $this->satkaiModel->findAll(), // Fetch all positions
            'tcm' => $this->tcmModel->orderBy('jenisId')->findAll(), // Fetch all TCMs
            'surat' => $this->suratModel->findAll(),
            'tcmByTransferKeId' => $this->trxTcmModel->getTrxTcmByKegiatanTransferKeId($selectedTransferKeId),
            'trxTcmbyKegiatan' => $this->trxTcmModel->getTrxTcmByKegiatanId($idKegiatan),
            'kegiatan' => $this->kegiatanModel->find($idKegiatan), // Fetch all kegiatan records if needed
        ];

        return view('tcm/trxtcm', $data);
    }

    public function hapusTrxtcm($id)
    {
        // dd($this->request->getVar());
        d($id);
        $trxTcm = $this->trxTcmModel->find($id);
        $idKegiatan = $this->request->getVar('idKegiatan'); // Get the idKegiatan from the request
        if ($trxTcm) {
            $this->trxTcmModel->delete($id);
            // session()->setFlashdata('hapus', 'Berhasil menghapus transaksi TCM.');
            return redirect()->to('trxtcm/' . $idKegiatan)->with('hapus', 'berhasil menghapus transaksi'); // Redirect to the transaction page with the idKegiatan
        } else {
            session()->setFlashdata('error', 'Transaksi TCM not found.');
        }
    }

    public function historyTcm($tcmId)
    {
        $history = $this->db->table('trxtcm')
            ->select('*, trxtcm.created_at as tanggal_penempatan')
            ->join('posisi', 'posisi.id = trxtcm.posisiId')
            ->join('tcm', 'tcm.id = trxtcm.tcmId')
            ->where('tcmId', $tcmId)
            ->orderBy('trxtcm.created_at', 'DESC')
            ->get()
            ->getResultArray();

        return $history;
    }
}
