<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Kas extends BaseController
{
    public function index()
    {

        return view('kas/index');
    }
}
