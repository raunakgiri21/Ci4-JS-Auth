<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->post('logout', 'Home::logout');
$routes->get('signin', 'Auth::signin');
$routes->post('signin', 'Auth::signinPost');
$routes->get('signup', 'Auth::signup');
$routes->post('signup', 'Auth::signupPost');
