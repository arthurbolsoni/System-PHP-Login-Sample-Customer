<?php

//////////////////////////////bootstrap////////////////////////////////////

require __DIR__ . '/../vendor/autoload.php';

session_start();

// Instantiate the app
$settings = require __DIR__ . '/../app/settings.php';

$app = new \Slim\App($settings);

$container = $app->getContainer();

$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container['settings']['db']);
$capsule->SetAsGlobal();
$capsule->bootEloquent();

$container['db'] = function ($container) use ($capsule){
    return $capsule;
};

//Middleware
//$app->add(new \App\Middleware\ValidationErrorsMiddleware($container ));
//$app->add(new \App\Middleware\CsrfViewMiddleware($container));


// Set up dependencies
$dependencies = require __DIR__ . '/../app/dependencies.php';
$dependencies($app);

// Register routes
$routes = require __DIR__ . '/../app/routes.php';
$routes($app);

//////////////////////////////////index.php//////////////////////////////////

// Run app
$app->run();
