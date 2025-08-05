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
