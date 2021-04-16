<?php

namespace App\Controller;

class HelloController
{
    public function sayHello(array $currentRoute)
    {
        require __DIR__ . '/../../pages/hello.php';
    }
}
