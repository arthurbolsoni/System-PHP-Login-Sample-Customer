<?php

namespace App\Middleware;

class AdminMiddleware extends Middleware{
   public function __invoke($request, $response, $next) {
        if($this->container->auth->vendedor()->isadmin != 1){
           $this->container->flash->addMessage('error','Permissão negada.');
            if(!$this->container->auth->check()){
                return $response->WithRedirect($this->container->router->pathFor('auth.signin'));
            }
            return $response->WithRedirect($this->container->router->pathFor('home'));
       }

        $response = $next($request, $response);
        return $response;
    }
}