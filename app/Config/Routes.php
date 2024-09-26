<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->setAutoRoute(true);
$routes->get('choose-action', 'HomeController::chooseAction');

$routes->get('/', 'HomeController::index');
$routes->get('/entrer-donnees-personnelles', 'UserController::enterPersonalData');
$routes->post('/save-personal-data', 'UserController::savePersonalData');
$routes->get('/choose-action', 'HomeController::chooseAction');
$routes->get('/enter-food', 'FoodController::enterFood');
$routes->post('/calculate-activity', 'FoodController::calculateActivity');
$routes->get('/enter-activity', 'ActivityController::enterActivity');
$routes->post('/calculate-food', 'ActivityController::calculateFood');
$routes->get('/ranking', 'RankingController::index');