<?php

use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return function (RoutingConfigurator $configurator) {

    $configurator
        ->add('hello', '/hello/{name}')
        ->defaults(['name' => 'World', 'controller' => 'App\Controller\HelloController@sayHello'])

        ->add('list', '/')
        ->defaults(['controller' => 'App\Controller\TaskController@index'])

        ->add('create', '/create')
        ->defaults(['controller' => 'App\Controller\TaskController@create'])
        ->host('localhost')
        ->schemes(['http'])
        ->methods(['GET', 'POST'])

        ->add('show', '/show{id}') // {id<\d+>?100}
        ->defaults(['id' => 100, 'controller' => 'App\Controller\TaskController@show'])
        ->requirements(['id' => '\d+']);
};
