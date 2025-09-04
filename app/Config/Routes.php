<?php

use App\Controllers\Tcm;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
// Home
$routes->get('home', 'Home::index');
// Manual
$routes->get('home/manual/(:any)', 'Home::manual/$1');


// kas
$routes->match(['GET', 'POST'], 'kas', 'Kas::index');
$routes->delete('kas/(:num)', 'Kas::hapus/$1');
$routes->post('kas/edit/(:num)', 'Kas::edit/$1');



// jurnal
$routes->get('jurnal', 'Jurnal::index');
$routes->get('jurnal/(:num)', 'Jurnal::detail/$1');
$routes->post('jurnal/tambah', 'Jurnal::tambah');
$routes->delete('jurnal/(:num)', 'Jurnal::hapus/$1');
$routes->post('jurnal/edit/(:num)', 'Jurnal::edit/$1');
$routes->post('jurnal/tambahGiat', 'Jurnal::tambahGiat');
$routes->post('jurnal/editGiat/(:num)', 'Jurnal::editGiat/$1');
$routes->delete('jurnal/hapusGiat/(:num)', 'Jurnal::hapusGiat/$1');
$routes->get('jurnal/khusus/(:num)', 'Jurnal::index/$1');


// tcm
$routes->get('tcm', 'TcmController::index');
$routes->post('tcm', 'TcmController::store');
$routes->delete('tcm/(:num)', 'TcmController::delete/$1');

// tcm-rekap
$routes->post('tcm/rekap/addJenis', 'JenisTcmController::store');
$routes->post('tcm/rekap/editJenis/(:num)', 'JenisTcmController::update/$1');
$routes->delete('tcm/rekap/deleteJenisTcm', 'JenisTcmController::delete');
$routes->get('tcm/rekap/detail/(:num)', 'JenisTcmController::detail/$1');

//tcm-kegiatan
$routes->get('tcm/kegiatan', 'KegiatanTcmController::index');
$routes->post('tcm/kegiatan', 'KegiatanTcmController::store');
$routes->get('tcm/kegiatan/(:num)', 'KegiatanTcmController::show/$1');
$routes->put('tcm/kegiatan/(:num)', 'KegiatanTcmController::update/$1');
$routes->delete('tcm/kegiatan/(:num)', 'KegiatanTcmController::delete/$1');

// tcm-satkai
$routes->get('tcm/satkai', 'SatkaiController::index');
$routes->post('tcm/satkai', 'SatkaiController::store');
$routes->get('tcm/satkai/(:num)', 'SatkaiController::show/$1');
$routes->put('tcm/satkai/(:num)', 'SatkaiController::update/$1');
$routes->delete('tcm/satkai/(:num)', 'SatkaiController::delete/$1');

//tcm-surat
$routes->get('tcm/surat', 'SuratController::index');
$routes->post('tcm/surat', 'SuratController::store');
$routes->get('tcm/surat/(:num)', 'SuratController::show/$1');
$routes->put('tcm/surat/(:num)', 'SuratController::update/$1');
$routes->delete('tcm/surat/(:num)', 'SuratController::delete/$1');
