<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');


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

