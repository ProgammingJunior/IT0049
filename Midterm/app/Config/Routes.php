<?php
use CodeIgniter\Router\RouteCollection;
/** @var RouteCollection $routes */
$routes->get('/', 'AuthController::login');
$routes->get('login', 'AuthController::login');
$routes->post('login', 'AuthController::attempt');
$routes->group('', ['filter'=>'auth'], static function (RouteCollection $routes): void {
 $routes->post('logout','AuthController::logout');
 $routes->get('pos','SaleController::new'); $routes->post('sales','SaleController::create'); $routes->get('sales/history','SaleController::index');
 $routes->get('products','ProductController::index'); $routes->get('products/new','ProductController::new'); $routes->post('products','ProductController::create'); $routes->get('products/edit/(:num)','ProductController::edit/$1'); $routes->post('products/update/(:num)','ProductController::update/$1'); $routes->post('products/archive/(:num)','ProductController::archive/$1');
 $routes->get('customers','CustomerController::index'); $routes->get('customers/new','CustomerController::new'); $routes->post('customers','CustomerController::create'); $routes->get('customers/edit/(:num)','CustomerController::edit/$1'); $routes->post('customers/update/(:num)','CustomerController::update/$1'); $routes->post('customers/delete/(:num)','CustomerController::delete/$1');
 $routes->get('staff','StaffController::index'); $routes->get('staff/new','StaffController::new'); $routes->post('staff','StaffController::create'); $routes->get('staff/edit/(:num)','StaffController::edit/$1'); $routes->post('staff/update/(:num)','StaffController::update/$1'); $routes->post('staff/delete/(:num)','StaffController::delete/$1');
});