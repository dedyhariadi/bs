<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SuratModel;
use CodeIgniter\HTTP\ResponseInterface;

class SuratController extends BaseController
{

    protected $suratModel;

    public function __construct()
    {
        $this->suratModel = new SuratModel();
    }

    public function index()
    {

        return view('tcm/surat', [
            'surat' => $this->suratModel->findAll(),
        ]);
    }

    public function store(): ResponseInterface
    {

        // dd($this->request->getPost());
        $rules = [
            'noSurat'    => 'required',
            'tglSurat'  => 'required',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $file = $this->request->getFile('filePdf');
        $uploadedName = null;


        if ($file && $file->isValid() && ! $file->hasMoved()) {
            $uploadsPath = WRITEPATH . 'uploads';
            if (! is_dir($uploadsPath)) {
                mkdir($uploadsPath, 0755, true);
            }

            $newName = $file->getRandomName();
            $file->move($uploadsPath, $newName);

            // store the generated filename in a local variable for DB saving
            $uploadedName = $newName;
        }

        $data = [
            'noSurat'    => $this->request->getPost('noSurat'),
            'tglSurat'  => simpanTanggal($this->request->getPost('tglSurat')),
            'pejabat'  => $this->request->getPost('pejabat'),
            'perihal'  => $this->request->getPost('perihal'),
            'filePdf'  => $uploadedName,
        ];

        // dd($data, $file);

        $insertId = $this->suratModel->insert($data);
        if ($insertId === false) {
            return redirect()->back()->withInput()->with('errors', $this->suratModel->errors());
        }

        return redirect()->to('tcm/surat')->with('success', 'Surat berhasil disimpan.');
    }

    public function update($id): ResponseInterface
    {
        $rules = [
            'noSurat'   => 'required',
            'tglSurat'  => 'required',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $existing = $this->suratModel->find($id);
        if (! $existing) {
            return redirect()->back()->with('errors', ['notFound' => 'Data tidak ditemukan.']);
        }

        $file = $this->request->getFile('filePdf');
        $uploadedName = $existing['filePdf'] ?? null;

        if ($file && $file->isValid() && ! $file->hasMoved()) {
            $uploadsPath = WRITEPATH . 'uploads';
            if (! is_dir($uploadsPath)) {
                mkdir($uploadsPath, 0755, true);
            }

            $newName = $file->getRandomName();
            $file->move($uploadsPath, $newName);

            // remove old file if present
            if (! empty($existing['filePdf'])) {
                $oldPath = $uploadsPath . DIRECTORY_SEPARATOR . $existing['filePdf'];
                if (is_file($oldPath)) {
                    @unlink($oldPath);
                }
            }

            $uploadedName = $newName;
        }

        $data = [
            'noSurat'   => $this->request->getVar('noSurat'),
            'tglSurat'  => simpanTanggal($this->request->getVar('tglSurat')),
            'pejabat'   => $this->request->getVar('pejabat'),
            'perihal'   => $this->request->getVar('perihal'),
            'filePdf'   => $uploadedName,
        ];

        $updated = $this->suratModel->update($id, $data);
        if ($updated === false) {
            return redirect()->back()->withInput()->with('errors', $this->suratModel->errors());
        }

        return redirect()->to('tcm/surat')->with('success', 'Surat berhasil diperbarui.');
    }

    public function delete($id): ResponseInterface
    {
        $existing = $this->suratModel->find($id);
        if (! $existing) {
            return redirect()->back()->with('errors', ['notFound' => 'Data tidak ditemukan.']);
        }

        $deleted = $this->suratModel->delete($id);
        if ($deleted === false) {
            return redirect()->back()->with('errors', $this->suratModel->errors());
        }

        if (! empty($existing['filePdf'])) {
            $uploadsPath = WRITEPATH . 'uploads';
            $filePath = $uploadsPath . DIRECTORY_SEPARATOR . $existing['filePdf'];
            if (is_file($filePath)) {
                @unlink($filePath);
            }
        }

        return redirect()->to('tcm/surat')->with('success', 'Surat berhasil dihapus.');
    }
}
