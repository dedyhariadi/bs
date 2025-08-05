<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Tcm extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Tcm',
            'terbilang' => terbilang(1234567890), // Contoh penggunaan fungsi terbilang
        ];

        return view('tcm', $data);
    }
}
