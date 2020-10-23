<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

use \App\Middleware\AuthMiddleware;
use \App\Middleware\AdminMiddleware;
use \App\Middleware\GuestMiddleware;
use \App\Database;
use \App\Models\Cliente;

return function (App $app) {
    $container = $app->getContainer();

    $app->group('', function () use ($container){
        
        $this->get('/auth/signout', 'AuthController:getSignOut')->setName('auth.signout');

        //bookmarkcontroller
        $this->get('/bookmark', 'BookMarkController:bookMark')->setName('bookmark');
        $this->post('/bookmark/add', 'BookMarkController:addToBookMark')->setName('addbookmark');

        //clientecontroller
        $this->get('/create_cliente', 'ClienteController:createCliente')->setName('cliente.create');
        $this->post('/create_cliente', 'ClienteController:setCreateCliente');
        $this->get('/update_cliente/[{id}]', 'ClienteController:updateCliente')->setName('cliente.update');
        $this->post('/update_cliente', 'ClienteController:setUpdateCliente');
        $this->get('/read_cliente/[{id}]', 'ClienteController:readCliente')->setName('cliente.read');
            
        //homecontroller
        $this->get('/searchcliente', 'HomeController:searchByQuery')->setName('search');
        $this->get('/[{page}]', 'HomeController:home')->setName('home');
    })->add(new AuthMiddleware($container));
        
    $app->group('', function () use ($container){
        $this->get('/auth/vendedor/signup', 'AuthController:getSignUp')->setName('auth.signup')->add($container->get('csrf'));
        $this->post('/auth/vendedor/signup', 'AuthController:postSignUp');
    })->add(new AdminMiddleware($container));

    $app->group('', function () use ($container){
        $this->get('/auth/signin', 'AuthController:getSignIn')->setName('auth.signin')->add($container->get('csrf'));;
        $this->post('/auth/signin', 'AuthController:postSignIn')->add($container->get('csrf'));;
    })->add(new GuestMiddleware($container));
};
