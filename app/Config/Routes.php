<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('home/manual/(:any)', 'Home::manual/$1');

// kas testbench
$routes->get('kas', 'Kas::index');
