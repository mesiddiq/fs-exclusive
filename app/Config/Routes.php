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
$routes->get('/about', 'Home::about');
$routes->get('/contact', 'Home::contact');
$routes->post('/contact', 'Home::submitContact');
$routes->post('/country', 'Home::country');
// Search
$routes->get('/search', 'Home::search');
// Products
$routes->get('/shop', 'Home::shop');
$routes->get('/category/(:any)/(:num)', 'Home::category/$1/$2');
$routes->get('/product/(:any)/(:num)', 'Home::product/$1/$2');
// Wishlist
$routes->get('/wishlist', 'Home::wishlist');
$routes->post('/toggleWishlist', 'Home::toggleWishlist');
// Cart
$routes->get('/cart', 'Home::cart');
$routes->post('/addToCart', 'Home::addToCart');
$routes->post('/updateCart', 'Home::updateCart');
$routes->post('/removeFromCart', 'Home::removeFromCart');
$routes->post('/removeFromSessionCart', 'Home::removeFromSessionCart');
$routes->post('/deleteUserCart', 'Home::deleteUserCart');
// Variant Cart
$routes->post('/getVariantColor', 'Home::getVariantColor');
$routes->post('/addToCartVariant', 'Home::addToCartVariant');
// $routes->get('/updateProductQuantity', 'Home::updateProductQuantity');
// Address
$routes->post('/addAddress', 'Home::addAddress');
$routes->post('/getAddress', 'Home::getAddress');
$routes->post('/updateAddress', 'Home::updateAddress');
// Shipping
$routes->post('/getShipping', 'Home::getShipping');
$routes->post('/getShippingCountries', 'Home::getShippingCountries');
// Coupon
$routes->post('/applyCoupon', 'Home::applyCoupon');
$routes->post('/removeCoupon', 'Home::removeCoupon');
// Checkout
$routes->post('/proceedToCheckout', 'Home::proceedToCheckout');
$routes->get('/checkout', 'Home::checkout');
$routes->post('/placeOrder', 'Home::placeOrder');
// Orders
$routes->get('/orders', 'Home::orders');
$routes->get('/orders/(:alpha)/(:any)', 'Home::orders/$1/$2');
// Product Review
$routes->post('/review', 'Home::review');
// On Demand Product
$routes->get('/pre-order', 'Home::preOrder');
$routes->post('/customProduct', 'Home::customProduct');
// Test Mail
$routes->get('/sendmail', 'Home::sendMail');
// Payment Gateway
$routes->get('/paymentStatus', 'Home::paymentStatus');
$routes->get('/order-confirmation', 'Home::orderConfirmation');
// Privacy Policy
$routes->get('/privacy-policy', 'Home::privacyPolicy');
// Terms
$routes->get('/terms', 'Home::terms');
// Refund Policy
$routes->get('/refund-policy', 'Home::refundPolicy');
// Login
$routes->post('/login', 'Login::index');
$routes->post('/register', 'Login::register');
$routes->post('/forgot', 'Login::forgot');
$routes->get('/reset', 'Login::reset');
$routes->get('/login/google', 'Login::google');
$routes->get('/login/facebook', 'Login::facebook');
$routes->post('/change', 'Login::change');
$routes->get('/logout', 'Login::logout');

/*
 * --------------------------------------------------------------------
 * Backend
 * --------------------------------------------------------------------
 */
$routes->get('/admin', 'Admin::index');
// Dashboard
$routes->get('/admin/dashboard', 'Admin::dashboard');
// Coupons
$routes->get('/admin/coupons', 'Admin::coupons');
$routes->get('/admin/coupons/(:alpha)', 'Admin::coupons/$1');
$routes->post('/admin/coupons/(:alpha)', 'Admin::coupons/$1');
$routes->get('/admin/coupons/(:alpha)/(:num)', 'Admin::coupons/$1/$2');
$routes->post('/admin/coupons/(:alpha)/(:num)', 'Admin::coupons/$1/$2');
// Categories
$routes->get('/admin/categories', 'Admin::categories');
$routes->get('/admin/categories/(:alpha)', 'Admin::categories/$1');
$routes->post('/admin/categories/(:alpha)', 'Admin::categories/$1');
$routes->get('/admin/categories/(:alpha)/(:num)', 'Admin::categories/$1/$2');
$routes->post('/admin/categories/(:alpha)/(:num)', 'Admin::categories/$1/$2');
// Products
$routes->get('/admin/products', 'Admin::products');
$routes->get('/admin/products/(:alpha)', 'Admin::products/$1');
$routes->post('/admin/products/(:alpha)', 'Admin::products/$1');
$routes->get('/admin/products/(:alpha)/(:num)', 'Admin::products/$1/$2');
$routes->post('/admin/products/(:alpha)/(:num)', 'Admin::products/$1/$2');
$routes->post('/admin/products/(:alpha)/(:alpha)', 'Admin::products/$1/$2');
// Attributes
$routes->get('/admin/attributes', 'Admin::attributes');
$routes->post('/admin/attributes/(:alpha)', 'Admin::attributes/$1');
$routes->get('/admin/attributes/(:alpha)/(:alpha)', 'Admin::attributes/$1/$2');
$routes->post('/admin/attributes/(:alpha)/(:alpha)', 'Admin::attributes/$1/$2');
$routes->get('/admin/attributes/(:alpha)/(:alpha)/(:num)', 'Admin::attributes/$1/$2/$3');
$routes->post('/admin/attributes/(:alpha)/(:alpha)/(:num)', 'Admin::attributes/$1/$2/$3');
// Orders
$routes->get('/admin/orders', 'Admin::orders');
$routes->get('/admin/orders/(:alpha)/(:num)', 'Admin::orders/$1/$2');
$routes->post('/admin/orders/(:alpha)/(:num)', 'Admin::orders/$1/$2');
// Reviews
$routes->get('/admin/reviews', 'Admin::reviews');
$routes->get('/admin/reviews/(:alpha)', 'Admin::reviews/$1');
$routes->post('/admin/reviews/(:alpha)', 'Admin::reviews/$1');
$routes->get('/admin/reviews/(:alpha)/(:num)', 'Admin::reviews/$1/$2');
$routes->post('/admin/reviews/(:alpha)/(:num)', 'Admin::reviews/$1/$2');
// Requirements
$routes->get('/admin/requirements', 'Admin::requirements');
$routes->get('/admin/requirements/(:alpha)/(:num)', 'Admin::requirements/$1/$2');
// Users
$routes->get('/admin/users', 'Admin::users');
$routes->get('/admin/users/(:alpha)', 'Admin::users/$1');
$routes->post('/admin/users/(:alpha)', 'Admin::users/$1');
$routes->get('/admin/users/(:alpha)/(:num)', 'Admin::users/$1/$2');
$routes->post('/admin/users/(:alpha)/(:num)', 'Admin::users/$1/$2');
// Logo
$routes->get('/admin/logo', 'Admin::logo');
$routes->post('/admin/logo/(:alpha)', 'Admin::logo/$1');
// Social Media
$routes->get('/admin/social-links', 'Admin::socialLinks');
$routes->post('/admin/social-links/(:alpha)', 'Admin::socialLinks/$1');
// Testimonials
$routes->get('/admin/testimonials', 'Admin::testimonials');
$routes->post('/admin/testimonials/(:alpha)', 'Admin::testimonials/$1');
// Countries
$routes->get('/admin/countries', 'Admin::countries');
$routes->get('/admin/countries/(:alpha)', 'Admin::countries/$1');
$routes->post('/admin/countries/(:alpha)', 'Admin::countries/$1');
$routes->get('/admin/countries/(:alpha)/(:num)', 'Admin::countries/$1/$2');
$routes->post('/admin/countries/(:alpha)/(:num)', 'Admin::countries/$1/$2');
// Shipping
$routes->get('/admin/shipping', 'Admin::shipping');
$routes->get('/admin/shipping/(:alpha)', 'Admin::shipping/$1');
$routes->get('/admin/shipping/(:alpha)/(:alpha)', 'Admin::shipping/$1/$2');
$routes->post('/admin/shipping/(:alpha)/(:alpha)', 'Admin::shipping/$1/$2');
$routes->get('/admin/shipping/(:alpha)/(:alpha)/(:num)', 'Admin::shipping/$1/$2/$3');
$routes->post('/admin/shipping/(:alpha)/(:alpha)/(:num)', 'Admin::shipping/$1/$2/$3');
// Privacy Policy
$routes->get('/admin/privacy-policy', 'Admin::privacyPolicy');
$routes->post('/admin/privacy-policy/(:alpha)', 'Admin::privacyPolicy/$1');
// Terms
$routes->get('/admin/terms', 'Admin::terms');
$routes->post('/admin/terms/(:alpha)', 'Admin::terms/$1');
// Refund Policy
$routes->get('/admin/refund-policy', 'Admin::refundPolicy');
$routes->post('/admin/refund-policy/(:alpha)', 'Admin::refundPolicy/$1');
// Others
$routes->post('/admin/updateAdminProductCountryId', 'Admin::updateAdminProductCountryId');
$routes->get('/admin/testpage', 'Admin::testpage');

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
