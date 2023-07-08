<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

$routes->get('/account', 'Home::account', ['filter' => 'authGuard']);

$routes->post('/authenticate', 'Auth::login');

$routes->get('/create', 'Auth::create');

$routes->get('/logout', 'Auth::logout', ['filter' => 'authGuard']);

$routes->get('/home', 'Home::home', ['filter' => 'authGuard']);

$routes->post('/cadastrar', 'Auth::cadastro');

$routes->get('/ouvinte/(:segment)', 'Inscricao::ouvinte/$1', ['filter' => 'authGuard']);

$routes->get('/autor/(:segment)', 'Eventos::autor/$1', ['filter' => 'authGuard']);

$routes->get('/cancelar/(:segment)', 'Inscricao::cancelar/$1', ['filter' => 'authGuard']);

$routes->post('autor/inscreverautor', 'Inscricao::inscreverAutor', ['filter' => 'authGuard']);

$routes->post('/pesquisaEventos', 'Eventos::pesquisaEventos', ['filter' => 'authGuard']);

$routes->post('/novo-usuario', 'Usuario::cadastro', ['filter' => 'authGuard']);

$routes->add('/buscaEventoPorId', 'Eventos::buscaEventosPorId', ['filter' => 'authGuard']);

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
