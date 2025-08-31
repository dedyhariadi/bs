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

// tcm
$routes->get('tcm', 'Tcm::index');
$routes->get('tcm/detail/(:num)', 'Tcm::detail/$1');
$routes->post('tcm/tambah', 'Tcm::tambah');
$routes->post('tcm/edit/(:num)', 'Tcm::edit/$1');
$routes->delete('tcm/(:num)', 'Tcm::hapus/$1');

$routes->get('tcm/surat', 'Tcm::surat');
$routes->post('tcm/tambahsurat', 'Tcm::tambahSurat');
$routes->delete('tcm/hapussurat/(:num)', 'Tcm::hapusSurat/$1');
$routes->post('tcm/editsurat/(:num)', 'Tcm::editSurat/$1');

$routes->post('tcm/kegiatan/(:num)', 'Tcm::editKegiatan/$1');
$routes->delete('tcm/kegiatan/(:num)', 'Tcm::hapusKegiatan/$1');
$routes->post('tcm/tambahkegiatan', 'Tcm::tambahKegiatan');

// transaksi tcm
$routes->match(['GET', 'POST'], 'trxtcm/(:num)', 'Tcm::trxtcm/$1');
$routes->delete('trxtcm/(:num)', 'Tcm::hapusTrxtcm/$1');
// $routes->post('trxtcm/(:num)', 'Tcm::trxtcm/$1');

// history penempatan tcm
$routes->get('tcm/history/(:num)', 'Tcm::historyPenempatan/$1');

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

// Routes untuk TcmController (baru)
$routes->get('/tcm-dashboard', 'TcmController::index');
$routes->get('/tcm-dashboard/create', 'TcmController::create');
$routes->post('/tcm-dashboard/store', 'TcmController::store');
$routes->get('/tcm-dashboard/edit/(:num)', 'TcmController::edit/$1');
$routes->post('/tcm-dashboard/update/(:num)', 'TcmController::update/$1');
$routes->delete('/tcm-dashboard/delete/(:num)', 'TcmController::delete/$1');
