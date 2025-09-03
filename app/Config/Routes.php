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

$routes->post('tcm/rekap/addJenis', 'JenisTcmController::store');
$routes->post('tcm/rekap/editJenis/(:num)', 'JenisTcmController::update/$1');
$routes->delete('tcm/rekap/deleteJenisTcm', 'JenisTcmController::delete');
$routes->get('tcm/rekap/detail/(:num)', 'JenisTcmController::detail/$1');
