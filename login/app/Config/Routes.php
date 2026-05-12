<?php

$routes->get('/register', 'Auth::register');
$routes->post('/register', 'Auth::registerPost');

$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::loginPost');

$routes->get('/users', 'UserController::index');
$routes->get('/users/create', 'UserController::create');
$routes->post('/users/store', 'UserController::store');

$routes->get('/users/edit/(:num)', 'UserController::edit/$1');
$routes->post('/users/update/(:num)', 'UserController::update/$1');

$routes->get('/users/delete/(:num)', 'UserController::delete/$1');

$routes->get('/dashboard', 'Auth::dashboard');
$routes->get('/logout', 'Auth::logout');
