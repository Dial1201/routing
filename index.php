<?php

use App\Controller\HelloController;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Generator\UrlGenerator;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

require __DIR__ . '/vendor/autoload.php';



$listeRoute = new Route('/');
$createRoute = new Route('/create', [], [], [], 'localhost', ['http'], ['POST', 'GET']);
$showRoute = new Route('/show/{id<\d+>?100}');
$helloRoute = new Route(
    '/hello/{name}',
    ['name' => 'World', 'controller' => [new HelloController, 'sayHello']]
);

$collection = new RouteCollection;
$collection->add('list', $listeRoute);
$collection->add('create', $createRoute);
$collection->add('show', $showRoute);
$collection->add('hello', $helloRoute);

$matcher = new UrlMatcher($collection, new RequestContext());

$generator = new UrlGenerator($collection, new RequestContext());



$pathInfo = $_SERVER['PATH_INFO'] ?? '/';

try {
    $currentRoute = $matcher->match($pathInfo);

    dump($currentRoute);

    $controller = $currentRoute['controller'];
    call_user_func($controller, $currentRoute);
    die();

    $page = $currentRoute['_route'];

    require_once "pages/$page.php";
} catch (ResourceNotFoundException $e) {
    require 'pages/404.php';
    return;
}
