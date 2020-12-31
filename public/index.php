<?php

if( !session_id() ) @session_start();

require_once "../vendor/autoload.php";

use Aura\SqlQuery\QueryFactory;
use Intervention\Image\ImageManager;
use League\Plates\Engine;
use DI\ContainerBuilder;
use Delight\Auth\Auth;

$containerBuilder = new ContainerBuilder();
$containerBuilder->addDefinitions([
    PDO::class => function() {
        $host = 'localhost';
        $dbname = 'database';
        $username = "root";
        $password = "root";
        return new PDO("mysql:host={$host}; dbname={$dbname}", "{$username}", "{$password}");
    },
    Engine::class => function() {
        return new Engine('../app/Views');
    },
    QueryFactory::class => function() {
        return new QueryFactory('mysql');
    },
    Auth::class => function($container) {
        return new Auth($container->get('PDO'));
    },
    ImageManager::class => function() {
        return new ImageManager(array('driver' => 'imagick'));
    }

]);

$container = $containerBuilder->build();


$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/', ['App\Controllers\HomeController', 'index']);
//    $r->addRoute('GET', '/posts/{id:\d+}', ['App\Controllers\HomeController', 'post']);


    $r->addRoute('GET', '/reg', ['App\Controllers\RegController', 'registration']);
    $r->addRoute('POST', '/reg', ['App\Controllers\RegController', 'create']);
    $r->addRoute('GET', '/verify/{selector:.+}/{token:.+}', ['App\Controllers\RegController', 'emailVerification']);

    $r->addRoute('GET', '/login', ['App\Controllers\AuthController', 'login']);
    $r->addRoute('POST', '/login', ['App\Controllers\AuthController', 'loginIn']);
    $r->addRoute('GET', '/logout', ['App\Controllers\AuthController', 'logOut']);

    $r->addRoute('GET', '/profile/{id:\d+}', ['App\Controllers\UserController', 'profile']);

    $r->addRoute('GET', '/edit/{id:\d+}', ['App\Controllers\UserController', 'editUser']);
    $r->addRoute('POST', '/edit/{id:\d+}', ['App\Controllers\UserController', 'editUserChange']);

    $r->addRoute('GET', '/security/{id:\d+}', ['App\Controllers\UserController', 'securityUser']);
    $r->addRoute('POST', '/security/{id:\d+}', ['App\Controllers\UserController', 'securityChange']);

    $r->addRoute('GET', '/status/{id:\d+}', ['App\Controllers\UserController', 'statusUser']);
    $r->addRoute('POST', '/status/{id:\d+}', ['App\Controllers\UserController', 'statusChange']);

    $r->addRoute('GET', '/media/{id:\d+}', ['App\Controllers\UserController', 'mediaUser']);
    $r->addRoute('POST', '/media/{id:\d+}', ['App\Controllers\UserController', 'mediaUpload']);

    $r->addRoute('GET', '/create', ['App\Controllers\AdminController', 'createUser']);
    $r->addRoute('POST', '/create', ['App\Controllers\AdminController', 'create']);


    $r->addRoute('GET', '/delete/{id:\d+}', ['App\Controllers\UserController', 'deleteUser']);

    $r->addRoute('GET', '/404', ['App\Controllers\HomeController', 'notFound']);
});

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        header('Location: /404');
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        echo '405 Method Not Allowed';
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        $container->call($handler, [$vars]);
        break;
}

