<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('dashboard');
    }

    public function manual(string $jenisManual): string
    {
        if ($jenisManual === 'torpedo') {
            return view('manual/torpedo');
        } elseif ($jenisManual === 'alattest') {
            return view('manual/testbench');
        } else {
            throw new \InvalidArgumentException("Jenis manual tidak dikenal: $jenisManual");
        }
    }
}
