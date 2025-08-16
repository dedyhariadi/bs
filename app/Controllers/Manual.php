<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Manual extends BaseController
{
    public function index()
    {
        return view('manual/torpedo');
    }
}
