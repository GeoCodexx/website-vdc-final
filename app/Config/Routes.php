<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
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
$routes->set404Override();
$routes->setAutoRoute(false);
//cambio a false para q solo reconozca alas rutas declaradas y no  coincidencia con el controlador y metodo
/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
/*RUTAS ESTATICAS*/
$routes->group('/', function($routes){
    $routes->get('', 'Home::index');
    $routes->get('about', 'About::index');
    $routes->group('services', function ($routes) {
        $routes->get('initial', 'Services::inicial');
        $routes->get('primary', 'Services::primaria');
    });  
    $routes->get('events', 'Events::index');
    $routes->get('notices', 'Notices::index');
    $routes->get('contact', 'Contact::index');
});
$routes->get('getReleaseLast','Release::getReleaseLast',['as'=>'get.release.last']);
//RUTAS PARA EL ADMIN DE CONTENIDOS
/*Autenticacion */
$routes->group('admin', function($routes){
    $routes->get('', 'Auth::index');
    $routes->post('signin', 'Auth::signin');
});
        //RUTAS PROTEGIDAS
$routes->group('admin', ['filter'=>'AuthCheck'], function ($routes) {
    $routes->get('dashboard','Home::dashboard');
    $routes->get('signout', 'Auth::signout');

        //Comunicados
        $routes->group('releases', function ($routes) {
            $routes->get('','Release::releases',['as'=>'releases']);
	        $routes->post('add','Release::addRelease',['as'=>'add.release']);
            $routes->get('getAllReleases','Release::getAllReleases',['as'=>'get.all.releases']);
            $routes->post('getReleaseInfo','Release::getReleaseInfo',['as'=>'get.release.info']);
            $routes->post('updateRelease','Release::updateRelease',['as'=>'update.release']);
            $routes->post('deleteRelease','Release::deleteRelease',['as'=>'delete.release']);
        });
        //Eventos
    
        //Noticias
        //Usuarios
        /*
        $routes->group('users', function ($routes) {
            $routes->get('', 'User::listview');
            $routes->post('create', 'User::create');
            $routes->put('update', 'User::update');
            $routes->get('detail/(:num)', 'User::detail');
            $routes->delete('delete/(:num)', 'User::delete');
        });*/
});
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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
