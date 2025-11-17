<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Auth'); 
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();

// =========================================================================
// RUTE UTAMA (LOGIN/LOGOUT)
// =========================================================================
$routes->get('/', 'Auth::index');
$routes->get('login', 'Auth::index');           
$routes->post('auth/login', 'Auth::login');     
$routes->get('logout', 'Auth::logout');         

// =========================================================================
// RUTE GROUP ADMIN
// =========================================================================
$routes->group('admin', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'Admin::dashboard');
    $routes->get('dashboard', 'Admin::dashboard');
    $routes->get('monitoring', 'Admin::monitoring');
    
    // Manajemen Pengguna (CRUD)
    $routes->get('users', 'Admin::users');
    $routes->get('users/new', 'Admin::newUser');
    $routes->post('users/create', 'Admin::createUser');
    $routes->get('users/edit/(:num)', 'Admin::editUser/$1');
    $routes->post('users/update', 'Admin::updateUser'); 
    $routes->get('users/delete/(:num)', 'Admin::deleteUser/$1'); 
});

// =========================================================================
// RUTE GROUP USER (LENGKAP CRUD PANEN)
// =========================================================================
$routes->group('user', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'User::dashboard');
    $routes->get('dashboard', 'User::dashboard');
    
    // Manajemen Panen (READ, CREATE, EDIT, DELETE)
    $routes->get('panen', 'User::listPanen');                                  // 1. READ ALL
    $routes->get('panen/new', 'User::newPanen');                               // 2. CREATE (Form)
    $routes->post('panen/create', 'User::createPanen');                        // 3. CREATE (Process)
    $routes->get('panen/edit/(:num)', 'User::editPanen/$1');                   // 4. EDIT (Form)
    $routes->post('panen/update', 'User::updatePanen');                        // 5. EDIT (Process)
    $routes->get('panen/delete/(:num)', 'User::deletePanen/$1');               // 6. DELETE
    
    // Monitoring Produksi
    $routes->get('monitoring', 'User::monitoringProduksi');
    
});