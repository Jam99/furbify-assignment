<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//main
$routes->get("/", "Main::index");

//ajax
$routes->post("/ajax/create-contact", "Main::ajaxCreateContact");
$routes->post("/ajax/del-contact", "Main::ajaxDeleteContact");
