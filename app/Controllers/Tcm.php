<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Jenis as JenisModel;
use App\Models\Posisi as PosisiModel; // Uncomment if you need to use PosisiModel
use App\Models\Tcm as TcmModel; // Uncomment if you need to use TcmModel
use App\Models\Surat as SuratModel; // Uncomment if you need to use SuratModel


class Tcm extends BaseController
{

    protected $jenisModel;
    protected $posisiModel;
    protected $tcmModel;
    protected $suratModel;


    public function __construct()
    {
        $this->jenisModel = new JenisModel();
        $this->posisiModel = new PosisiModel();
        $this->tcmModel = new TcmModel();
        $this->suratModel = new SuratModel(); // Initialize SuratModel if needed
    }

    public function index()
    {

        $data = [
            'title' => 'Tcm',
            'jenis' => $this->jenisModel->findAll(),
            'posisi' => $this->posisiModel->findAll(), // Fetch all positions
            'tcm' => $this->tcmModel->findAll(), // Fetch all TCMs
            'surat' => $this->suratModel->findAll(), // Fetch all surat records if needed

        ];

        return view('tcm/index', $data);
    }

    public function detail($id)
    {
        $data = [
            'title' => 'Detail Tcm',
            'jenis' => $this->jenisModel->find($id),
            'posisi' => $this->posisiModel->findAll(), // Fetch all positions
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

    public function suratIndex()
    {
        $data = [
            'title' => 'Surat Index',
            'jenis' => $this->jenisModel->findAll(),
            'posisi' => $this->posisiModel->findAll(), // Fetch all positions
            'tcm' => $this->tcmModel->findAll(), // Fetch all TCMs
        ];

        return view('tcm/suratIndex', $data);
    }
}
