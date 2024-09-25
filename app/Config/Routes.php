<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->setAutoRoute(true);
$routes->get('/Visiteur/accueil', 'Visiteur::accueil');

$routes->get('activite/new', 'Activite::new');
$routes->post('activite', 'Activite::create');
$routes->get('activite', 'Activite::index');
$routes->get('activite/(:segment)', 'Activite::show/$1');
$routes->get('activite/(:segment)/edit', 'Activite::edit/$1');
$routes->put('activite/(:segment)', 'Activite::update/$1');
$routes->patch('activite/(:segment)', 'Activite::update/$1');
$routes->delete('activite/(:segment)', 'Activite::delete/$1');

$routes->group('activite', ['filter' => 'filtresuper'], function($routes) {
    $routes->get("/", "User::index");
    $routes->get("(:any)", "User::show/$1");
    $routes->post("/", "User::create");
    $routes->put("(:any)", "User::update/$1");
    $routes->delete("(:any)", "User::delete/$1");
});