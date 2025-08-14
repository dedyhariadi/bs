<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Jurnal as JurnalModel; // Import the Jurnal model
use CodeIgniter\I18n\Time;

class Jurnal extends BaseController
{
    protected $Jurnalmodel;

    public function __construct()
    {
        $this->Jurnalmodel = new JurnalModel();
    }

    public function index()
    {
        // $model = new \App\Models\Jurnal();
        $data['jurnal'] = $this->Jurnalmodel->findAll();

        return view('jurnal/index', $data);
    }

    public function tambah()
    {

        $data = [
            // 'tanggal' => $tanggal_untuk_db,
            'tanggal' => simpanTanggal($this->request->getPost('tanggal')),
            'jenis' => 'harian',
            'kegiatan' => $this->request->getPost('kegiatan'),
            'foto' => $this->request->getPost('foto'),

        ];

        // Validasi input
        if (!$this->validate([
            'tanggal' => 'required',
            'kegiatan' => 'required',
            'foto' => 'permit_empty|uploaded[foto]|max_size[foto,2048]|is_image[foto]',
        ])) {
            // Jika validasi gagal, kembalikan ke halaman sebelumnya dengan pesan error
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }       
        // Jika validasi berhasil, simpan data ke database
        if ($this->request->getFile('foto')->isValid()) {
            $foto = $this->request->getFile('foto');
            $namaFile = $foto->getRandomName();
            $foto->move('uploads/jurnal', $namaFile);
            $data['foto'] = $namaFile;
        } else {
            $data['foto'] = null; // Atau bisa diisi dengan nilai default lainnya
        }
        
        $this->Jurnalmodel->insert($data);

        // $data['jurnal'] = $this->Jurnalmodel->findAll();
        return redirect()->to('jurnal');
    }
}
