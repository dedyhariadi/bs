<?php

namespace App\Controllers;

use App\Models\JenisTcmModel;
use App\Models\TcmModel;

use CodeIgniter\HTTP\ResponseInterface;

class JenisTcmController extends BaseController
{
  protected $jenisTcmModel;
  protected $tcmModel;

  public function __construct()
  {
    $this->jenisTcmModel = new JenisTcmModel();
    $this->tcmModel = new TcmModel();
  }


  /**
   * Simpan jenis TCM baru
   */
  public function store()
  {
    $data = [
      'nama' => $this->request->getPost('nama'),
      'file' => $this->request->getPost('file'),
    ];

    $rules = [
      'nama' => 'required|min_length[3]|max_length[150]',
      'file' => 'permit_empty|max_length[200]',
    ];

    if (!$this->validate($rules)) {
      return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }


    if ($this->jenisTcmModel->insertJenis($data)) {
      return redirect()->to('/tcm')->with('success', 'Jenis TCM berhasil ditambahkan');
    } else {
      return redirect()->back()->withInput()->with('error', 'Gagal menambahkan jenis TCM');
    }
  }


  /**
   * Update jenis TCM
   * @param int $id
   */
  public function update($id)
  {
    $rules = [
      'nama' => 'required|min_length[3]|max_length[150]',
      'file' => 'permit_empty|max_length[200]',
    ];

    if (!$this->validate($rules)) {
      return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    $data = [
      'nama' => $this->request->getPost('nama'),
      'file' => $this->request->getPost('file'),
    ];

    if ($this->jenisTcmModel->updateJenis($id, $data)) {
      return redirect()->to('/tcm')->with('success', 'Jenis TCM berhasil diupdate');
    } else {
      return redirect()->back()->withInput()->with('error', 'Gagal mengupdate jenis TCM');
    }
  }

  /**
   * Hapus jenis TCM
   * @param int $id
   */
  public function delete()
  {

    $id = $this->request->getVar('id');

    $nama = $this->jenisTcmModel->find($id)['nama'];

    if ($this->jenisTcmModel->deleteJenis($id)) {
      return redirect()->to('tcm')->with('success', $nama . ' berhasil dihapus');
    } else {
      return redirect()->back()->with('error', 'Gagal menghapus jenis TCM');
    }
  }

  public function detail($id)
  {
    $data['jenisTcm'] = $this->jenisTcmModel->find($id);
    if (!$data['jenisTcm']) {
      throw new \CodeIgniter\Exceptions\PageNotFoundException('Jenis TCM tidak ditemukan');
    }
    $data['tcmList'] = $this->tcmModel->getTcmByJenis($id);
    // Load view detail
    return view('tcm/rekap/detail', $data);
  }
}
