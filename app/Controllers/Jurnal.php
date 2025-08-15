<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Jurnal as JurnalModel;
use App\Models\GiatJurnal as GiatJurnalModel;
use CodeIgniter\I18n\Time;

class Jurnal extends BaseController
{
    protected $Jurnalmodel;
    protected $GiatJurnalmodel;

    public function __construct()
    {
        $this->Jurnalmodel = new JurnalModel();
        $this->GiatJurnalmodel = new GiatJurnalModel();
    }

    public function index()
    {
        $data = [
            'jurnal' => $this->Jurnalmodel->orderBy('tanggal', 'desc')->findAll(),
            'giatJurnal' => $this->GiatJurnalmodel->findAll(),
        ];

        return view('jurnal/index', $data);
    }

    public function tambah()
    {

        // Tentukan aturan validasi // Periksa apakah tanggal yang diinput sudah ada di jurnal lain
        $existingJurnal = $this->Jurnalmodel->where('tanggal', simpanTanggal($this->request->getPost('tanggal')))
            ->first();
        if ($existingJurnal) {
            $pesan = 'Jurnal pada ' . $this->request->getPost('tanggal') . ' sudah ada.';
            return redirect()->back()->withInput()->with('error', $pesan);
        }

        // Tentukan aturan validasi
        $rules = [
            'tanggal' => 'required',
            'kegiatan' => 'required',
            'foto' => [
                'permit_empty',
                'max_size[foto,2048]',
                'ext_in[foto,jpg,jpeg,png]',
                'mime_in[foto,image/jpg,image/jpeg,image/png]'
            ]
        ];

        // Jalankan validasi
        if (!$this->validate($rules)) {
            // Jika validasi GAGAL, ambil pesan error spesifik
            $error = $this->validator->getError('foto');
            if ($error) {
                // Jika error ada pada file foto, tampilkan pesan spesifik
                return redirect()->back()->withInput()->with('error', $error);
            } else {
                // Jika error ada pada field lain, tampilkan pesan generik
                return redirect()->back()->withInput()->with('error', 'Validasi gagal. Pastikan semua field terisi dengan benar.');
            }
        }

        // Jika validasi BERHASIL, baru proses data dan file
        $data = [
            'tanggal' => simpanTanggal($this->request->getPost('tanggal')),
            'jenis' => 'harian',
            'kegiatan' => $this->request->getPost('kegiatan'),
        ];

        $foto = $this->request->getFile('foto');

        // Periksa apakah ada file yang diunggah dan valid
        if ($foto->isValid() && !$foto->hasMoved()) {
            $namaFile = $foto->getRandomName();
            $foto->move('uploads/jurnal', $namaFile);
            $data['foto'] = $namaFile;
        } else {
            $data['foto'] = null;
        }

        if ($this->Jurnalmodel->insert($data)) {
            return redirect()->to('jurnal')->with('success', 'Jurnal berhasil ditambahkan.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan jurnal.');
        }
    }

    public function detail($id)
    {
        $data['jurnal'] = $this->Jurnalmodel->find($id);

        if (!$data['jurnal']) {
            return redirect()->to('jurnal')->with('error', 'Jurnal tidak ditemukan.');
        }

        return view('jurnal/detail', $data);
    }

    public function edit($id)
    {
        $jurnal = $this->Jurnalmodel->find($id);

        if (!$jurnal) {
            return redirect()->to('jurnal')->with('error', 'Jurnal tidak ditemukan.');
        }

        // Tentukan aturan validasi // Periksa apakah tanggal yang diinput sudah ada di jurnal lain
        $existingJurnal = $this->Jurnalmodel->where('tanggal', simpanTanggal($this->request->getPost('tanggal')))
            ->where('id !=', $id)
            ->first();
        if ($existingJurnal) {
            $pesan = 'Jurnal pada ' . $this->request->getPost('tanggal') . ' sudah ada.';
            return redirect()->back()->withInput()->with('error', $pesan);
        }

        $rules = [
            'tanggal' => 'required',
            'kegiatan' => 'required',
            'foto' => [
                'permit_empty',
                'max_size[foto,2048]',
                'ext_in[foto,jpg,jpeg,png]',
                'mime_in[foto,image/jpg,image/jpeg,image/png]'
            ]
        ];

        // Jalankan validasi
        if (!$this->validate($rules)) {
            // Jika validasi GAGAL, ambil pesan error spesifik
            $error = $this->validator->getError('foto');
            if ($error) {
                return redirect()->back()->withInput()->with('error', $error);
            } else {
                return redirect()->back()->withInput()->with('error', 'Validasi gagal. Pastikan semua field terisi dengan benar.');
            }
        }

        // Jika validasi BERHASIL, baru proses data dan file
        $data = [
            'id' => $id,
            'tanggal' => simpanTanggal($this->request->getPost('tanggal')),
            'jenis' => 'harian',
            'kegiatan' => $this->request->getPost('kegiatan'),
        ];

        $foto = $this->request->getFile('foto');

        // Periksa apakah ada file baru yang diunggah
        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            if ($jurnal['foto'] && file_exists('uploads/jurnal/' . $jurnal['foto'])) {
                unlink('uploads/jurnal/' . $jurnal['foto']);
            }
            $namaFile = $foto->getRandomName();
            $foto->move('uploads/jurnal', $namaFile);
            $data['foto'] = $namaFile;
        }

        if ($this->Jurnalmodel->update($id, $data)) {
            $pesan = "Jurnal hari " . tampilTanggal($jurnal['tanggal']) . " berhasil diperbarui.";
            return redirect()->to('jurnal')->with('success', $pesan);
        } else {

            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui jurnal.');
        }
    }

    public function hapus($id)
    {
        $jurnal = $this->Jurnalmodel->find($id);

        if (!$jurnal) {
            return redirect()->to('jurnal')->with('error', 'Jurnal tidak ditemukan.');
        }

        // Hapus file foto jika ada
        if ($jurnal['foto'] && file_exists('uploads/jurnal/' . $jurnal['foto'])) {
            unlink('uploads/jurnal/' . $jurnal['foto']);
        }

        if ($this->Jurnalmodel->delete($id)) {
            return redirect()->to('jurnal')->with('success', 'Berhasil menghapus jurnal hari ' . tampilTanggal($jurnal['tanggal']));
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus jurnal.');
        }
    }

    public function tambahGiat()
    {



        $rules = [
            'kegiatan' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Validasi gagal. Pastikan kegiatan terisi dengan benar.');
        }

        $data = [
            'kegiatan' => $this->request->getPost('kegiatan'),
        ];

        if ($this->GiatJurnalmodel->insert($data)) {
            return redirect()->to('jurnal')->with('success', 'Kegiatan berhasil ditambahkan.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan kegiatan.');
        }
    }

    public function hapusGiat($id)
    {
        $giat = $this->GiatJurnalmodel->find($id);

        if (!$giat) {
            return redirect()->to('jurnal')->with('error', 'Kegiatan tidak ditemukan.');
        }
        if ($this->GiatJurnalmodel->delete($id)) {
            return redirect()->to('jurnal')->with('success', 'Kegiatan berhasil dihapus.');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus kegiatan.');
        }
    }

    public function editGiat($id)
    {
        $giat = $this->GiatJurnalmodel->find($id);

        if (!$giat) {
            return redirect()->to('jurnal')->with('error', 'Kegiatan tidak ditemukan.');
        }
        $rules = [
            'kegiatan' => 'required',
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Validasi gagal. Pastikan kegiatan terisi dengan benar.');
        }
        $data = [
            'id' => $id,
            'kegiatan' => $this->request->getPost('kegiatan'),
        ];
        if ($this->GiatJurnalmodel->update($id, $data)) {
            return redirect()->to('jurnal')->with('success', 'Kegiatan berhasil diperbarui.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui kegiatan.');
        }
    }
}
