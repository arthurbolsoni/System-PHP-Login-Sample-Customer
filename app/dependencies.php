<?php

use Slim\App;

return function (App $app) {
    $container = $app->getContainer();

    $container['ClienteController'] = function ($container) {
        return new \App\Controllers\ClienteController($container);
    };

    $container['HomeController'] = function ($container) {
        return new \App\Controllers\HomeController($container);
    };

    $container['AuthController'] = function ($container) {
        return new \App\Controllers\Auth\AuthController($container);
    };

    $container['BookMarkController'] = function ($container) {
        return new \App\Controllers\BookMarkController($container);
    };

    $container['validator'] = function ($container){
        return new \App\Validation\Validator;
    };

    $container['auth'] = function ($container){
        return new \App\Auth\Auth;
    };
    
    //csrf
    $container['csrf'] = function ($container){
        return new \Slim\Csrf\Guard;
    };

    //$app->add($container->csrf);

    $container['flash'] = function ($container){
        return new \Slim\Flash\Messages;
    };
    ////////////////////////////////////////////////////////////////////////
        
    $container['view'] = function ($container){
        $view = new \Slim\Views\Twig(__DIR__ . '/../views', [
            'cache' => false,
        ]);

        $view->addExtension(new \Slim\Views\TwigExtension(
            $container->router,
            $container->request->getUri()
        ));

        $view->getEnvironment()->addGlobal('auth', [
            'check' => $container->auth->check(),
            'user' => $container->auth->vendedor(),
        ]);

        $view->getEnvironment()->addGlobal('flash', $container->flash);
        
        $view->addExtension(new \App\Middleware\CsrfMiddleware($container->csrf));
        
        return $view;
    };

    // view renderer
    $container['renderer'] = function ($c) {
        $settings = $c->get('settings')['renderer'];
        return new \Slim\Views\PhpRenderer($settings['template_path']);
    };
};
