<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
// $routes->match(['GET', 'POST'], '/', 'Home::index');

$routes->match(['GET', 'POST'], 'kas', 'Kas::index');
