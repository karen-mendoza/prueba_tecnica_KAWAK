<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../app/core/Router.php';
require_once __DIR__ . '/../app/core/Controller.php';
require_once __DIR__ . '/../app/core/Model.php';

// Autoload simple
spl_autoload_register(function ($class) {
    $paths = [
        __DIR__ . '/../app/controllers/' . $class . '.php',
        __DIR__ . '/../app/models/' . $class . '.php',
    ];
    foreach ($paths as $p) if (file_exists($p)) { require_once $p; return; }
});

$router = new Router('/prueba_tecnica_KAWAK/public');
$router->get('/', function () { (new HomeController)->index(); });
$router->post('/', function () {
    (new HomeController)->index();
});

$router->get('/documentos', function () { (new DocumentosController)->index(); });
$router->post('/documentos/subir', function () { (new DocumentosController)->subir(); });
$router->get('/documentos/editar/{id}', function ($p) {(new DocumentosController)->editar((int)$p['id']);});
$router->post('/documentos/actualizar/{id}', function ($p) {(new DocumentosController)->actualizar((int)$p['id']);});
$router->get('/documentos/eliminar/{id}', function ($p) {(new DocumentosController)->eliminar((int)$p['id']);});


$router->dispatch($_SERVER['REQUEST_METHOD'], parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
