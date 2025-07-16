<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('dashboard');
    }

    public function manual($jenis): string
    {
        // echo "Manual Book Torpedo";
        if ($jenis === 'torpedo') {
            return view('manual/torpedo');
        } elseif ($jenis === 'alattest') {
            return view('manual/alatTest');
        }
        // return view('manual/torpedo');
    }
}
