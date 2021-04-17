<?php


use App\Loader\CustomAnnotationClassLoader;
use Doctrine\Common\Annotations\AnnotationReader;

use Doctrine\Common\Annotations\AnnotationRegistry;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\Routing\RequestContext;

use Symfony\Component\Routing\Matcher\UrlMatcher;

use Symfony\Component\Routing\Generator\UrlGenerator;

use Symfony\Component\Routing\Loader\AnnotationDirectoryLoader;



require __DIR__ . '/../vendor/autoload.php';

// $loader = new PhpFileLoader(new FileLocator(__DIR__ . '/config'));
// $collection = $loader->load('routes.php');

// $loader = new YamlFileLoader(new FileLocator(__DIR__ . '/config'));
// $collection = $loader->load('routes.yaml');

$classLoader = require __DIR__ . '/../vendor/autoload.php';
AnnotationRegistry::registerLoader('class_exists');

$loader = new AnnotationDirectoryLoader(
    new FileLocator(__DIR__ . '/src/Controller'),
    new CustomAnnotationClassLoader(new AnnotationReader())
);

$collection = $loader->load(__DIR__ . '/../src/Controller');

$matcher = new UrlMatcher($collection, new RequestContext());

$generator = new UrlGenerator($collection, new RequestContext());


$pathInfo = $_SERVER['PATH_INFO'] ?? '/';
