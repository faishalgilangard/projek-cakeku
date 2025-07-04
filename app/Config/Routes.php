<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('login', 'AuthController::login');
$routes->post('login', 'AuthController::login');
$routes->get('logout', 'AuthController::logout');

$routes->get('katalog', 'Katalog::index', ['as' => 'katalog', 'filter' => 'auth']);

$routes->get('profile', 'UserController::profile');
$routes->post('profile/update', 'UserController::updateProfile');


$routes->group('produk', ['filter' => 'auth'], function ($routes) {
    $routes->get('', 'ProdukController::index');
    $routes->post('', 'ProdukController::create');
    $routes->post('edit/(:any)', 'ProdukController::edit/$1');
    $routes->get('delete/(:any)', 'ProdukController::delete/$1');
    $routes->get('download', 'ProdukController::download');
});

$routes->group('keranjang', ['filter' => 'auth'], function ($routes) {
    $routes->get('', 'TransaksiController::index');
    $routes->post('', 'TransaksiController::cart_add');
    $routes->post('edit', 'TransaksiController::cart_edit');
    $routes->get('delete/(:any)', 'TransaksiController::cart_delete/$1');
    $routes->get('clear', 'TransaksiController::cart_clear');
});

$routes->get('checkout', 'TransaksiController::checkout', ['filter' => 'auth']);
$routes->post('buy', 'TransaksiController::buy', ['filter' => 'auth']);

$routes->get('get-location', 'TransaksiController::getLocation', ['filter' => 'auth']);
$routes->get('get-cost', 'TransaksiController::getCost', ['filter' => 'auth']);

$routes->get('history', 'Katalog::history', ['filter' => 'auth']);

$routes->get('dashboard-toko', 'Dashboard::index', ['filter' => 'auth']);
$routes->get('dashboard-toko/cetak', 'Dashboard::cetak', ['filter' => 'auth']);
$routes->post('dashboard-toko/update-status/(:num)', 'Dashboard::updateStatus/$1', ['filter' => 'auth']);
$routes->post('dashboard-toko/delete/(:num)', 'Dashboard::delete/$1', ['filter' => 'auth']);
$routes->get('dashboard-toko/delete/(:num)', 'Dashboard::delete/$1', ['filter' => 'auth']);

$routes->resource('api', ['controller' => 'apiController']);
$routes->get('register', 'AuthController::register');
$routes->post('register', 'AuthController::register');
$routes->get('laporan', 'LaporanController::index', ['filter' => 'auth']);
$routes->get('laporan/cetak', 'LaporanController::cetak', ['filter' => 'auth']);
