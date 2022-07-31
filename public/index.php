<?php 

use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7Server\ServerRequestCreator;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../config/config.php';

$routes = require __DIR__ . '/../config/routes.php';
$pathInfo = $_SERVER['PATH_INFO'];

if ($pathInfo === null) {
    header('Location: /home');
    die();
}

if (!array_key_exists($pathInfo, $routes)) {
    http_response_code(404);
    die();
}

session_start();

$routeLogin = stripos($pathInfo, 'login');
if ( !isset ( $_SESSION['auth'] ) && $routeLogin === false ) {
    header('Location: /login');
    die();
}

$psr17Factory = new Psr17Factory();
$creator = new ServerRequestCreator(
    $psr17Factory,
    $psr17Factory,
    $psr17Factory,
    $psr17Factory
);
$serverRequest = $creator->fromGlobals();

$classControl = $routes[$pathInfo];
$container = require __DIR__ . '/../config/dependencies.php';
$control = $container->get($classControl);

$received = $control->handle($serverRequest);

foreach ($received->getHeaders() as $name => $values) {
    foreach ($values as $value) {
        header(sprintf('%s: %s', $name, $value), false);
    }
}

echo $received->getBody();