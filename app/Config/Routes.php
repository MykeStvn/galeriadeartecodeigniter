<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('CrudArtista');
$routes->setDefaultMethod('index');

$routes->get('/', 'CrudArtista::index');
$routes->get('/obtenerArtista/(:any)', 'CrudArtista::obtenerArtista/$1');
$routes->get('/eliminar/(:any)', 'CrudArtista::eliminar/$1');
$routes->post('/crear', 'CrudArtista::crear');
$routes->post('/actualizar', 'CrudArtista::actualizar');

//OBRAS
$routes->get('/obras', 'CrudObra::index');
$routes->post('/crear-obra', 'CrudObra::crear');
$routes->get('/obtenerObra/(:any)', 'CrudObra::obtenerObra/$1');
$routes->get('/eliminar-obra/(:any)', 'CrudObra::eliminar/$1');
$routes->post('/actualizarobras', 'CrudObra::actualizar');

// Modificar la ruta de las imágenes
$routes->get('uploads/(:any)', function($filename) {
    $path = WRITEPATH . 'uploads/' . $filename;
    if (file_exists($path)) {
        $mime = mime_content_type($path);
        header('Content-Type: ' . $mime);
        readfile($path);
        exit;
    }
    return 'Archivo no encontrado';
});
