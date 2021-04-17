<?php

namespace App\Controller;

class TaskController
{
    public function index(array $currentRoute)
    {
        $generator = $currentRoute['generator'];

        require __DIR__ . '/../../pages/list.php';
    }

    public function create(array $currentRoute)
    {
        $generator = $currentRoute['generator'];

        require __DIR__ . '/../../pages/create.php';
    }

    public function show(array $currentRoute)
    {
        $generator = $currentRoute['generator'];

        require __DIR__ . '/../../pages/show.php';
    }
}
