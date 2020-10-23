<?php

namespace App\Middleware;

class GuestMiddleware extends Middleware{
   public function __invoke($request, $response, $next) {
       if($this->container->auth->check()){
            return $response->WithRedirect($this->container->router->pathFor('home'));
       }

        $response = $next($request, $response);
        return $response;
    }
}