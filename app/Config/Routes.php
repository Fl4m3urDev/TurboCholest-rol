<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->setAutoRoute(true);
$routes->get('/Visiteur/accueil', 'Visiteur::accueil');

$routes->get('/saisie-activites', 'ActivityController::index'); 
$routes->post('/sauver-activite', 'ActivityController::save');  