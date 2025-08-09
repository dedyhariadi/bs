<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Jurnal extends BaseController
{
    public function index()
    {
        $model = new \App\Models\Jurnal();
        $data['jurnal'] = $model->findAll();

        return view('jurnal/index', $data);
    }
}
