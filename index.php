<?php

    require __DIR__ . '/applications/config.php';
    require __DIR__ . '/applications/libraries/Route.php';
    require __DIR__ . '/applications/libraries/Controller.php';
    require __DIR__ . '/applications/libraries/Database.php';
    require __DIR__ . '/applications/libraries/Model.php';

    $route = new Route();

    $route -> add('/', 'home') -> any();
    $route -> add('/todos', 'Todo/showAll') -> any();

    $route -> error('notfound');

    $route -> run();

?>