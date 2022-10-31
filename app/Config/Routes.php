<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override(function(){
    echo "your error message";
});
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

/*
 * --------------------------------------------------------------------
 * Frontend
 * --------------------------------------------------------------------
 */
$routes->get('/', 'Home::index');
$routes->post('/country', 'Home::country');
$routes->post('/login', 'Login::index');
$routes->post('/register', 'Login::register');
$routes->get('/logout', 'Login::logout');

// United Kingdom
$routes->get('/uk', 'Uk::index');
$routes->get('/uk/shop', 'Uk::shop');
$routes->get('/uk/category/(:any)/(:num)', 'Uk::category/$1/$2');
$routes->get('/uk/product/(:any)/(:num)', 'Uk::product/$1/$2');
$routes->get('/uk/cart', 'Uk::cart');
$routes->get('/uk/checkout', 'Uk::checkout');
$routes->get('/uk/contact', 'Uk::contact');

// Malaysia
$routes->get('/my', 'My::index');
$routes->get('/my/shop', 'My::shop');
$routes->get('/my/category/(:any)/(:num)', 'My::category/$1/$2');
$routes->get('/my/product/(:any)/(:num)', 'My::product/$1/$2');
$routes->get('/my/cart', 'My::cart');
$routes->get('/my/checkout', 'My::checkout');
$routes->get('/my/contact', 'My::contact');

/*
 * --------------------------------------------------------------------
 * Backend
 * --------------------------------------------------------------------
 */
$routes->get('/admin', 'Home::index');
$routes->get('/admin/login', 'Admin::login');
$routes->get('/admin/dashboard', 'Admin::dashboard');
$routes->get('/admin/categories', 'Admin::categories');
$routes->get('/admin/categories/(:alpha)', 'Admin::categories/$1');
$routes->post('/admin/categories/(:alpha)', 'Admin::categories/$1');
$routes->get('/admin/categories/(:alpha)/(:num)', 'Admin::categories/$1/$2');
$routes->post('/admin/categories/(:alpha)/(:num)', 'Admin::categories/$1/$2');
$routes->get('/admin/products', 'Admin::products');
$routes->get('/admin/products/(:alpha)', 'Admin::products/$1');
$routes->post('/admin/products/(:alpha)', 'Admin::products/$1');
$routes->get('/admin/products/(:alpha)/(:num)', 'Admin::products/$1/$2');
$routes->post('/admin/products/(:alpha)/(:num)', 'Admin::products/$1/$2');
$routes->get('/admin/users', 'Admin::users');
$routes->get('/admin/users/(:alpha)', 'Admin::users/$1');
$routes->post('/admin/users/(:alpha)', 'Admin::users/$1');
$routes->get('/admin/users/(:alpha)/(:num)', 'Admin::users/$1/$2');
$routes->post('/admin/users/(:alpha)/(:num)', 'Admin::users/$1/$2');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
