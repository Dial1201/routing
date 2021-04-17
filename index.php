<?php

use Symfony\Component\Routing\Exception\ResourceNotFoundException;

require __DIR__ . '/config/start.php';

try {
    $currentRoute = $matcher->match($pathInfo);


    $controller = $currentRoute['_controller']; //callable

    $currentRoute['generator'] = $generator;

    $className = substr($controller, 0, strpos($controller, '@'));
    $methodName = substr($controller, strpos($controller, '@') + 1);

    $instance = new $className;

    call_user_func([$instance, $methodName], $currentRoute);
} catch (ResourceNotFoundException $e) {
    require 'pages/404.html.php';
    return;
}
