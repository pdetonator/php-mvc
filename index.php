<?php 

    require __DIR__ . '/applications/libraries/Route.php';

    $route = new Route();

    $route -> add('/', 'home') -> any();
    $route -> add('/product', 'Product') -> post();

    $route -> run();

?>