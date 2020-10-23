<?php
namespace App\Controllers\Auth;

use \App\Controllers\Controller; 
use \App\Models\Vendedor; 
use \App\Models\Cliente;
use Slim\Views\Twig as View;
use Respect\Validation\Validator as v;

/**
 * Controller de Exemplo
 */
class AuthController extends Controller{

    public function getSignOut($request, $response){
        $this->auth->logout();
        return $this->view->render($response, 'auth/signin.twig');
    }
    
    public function getSignIn($request, $response){
        return $this->view->render($response, 'auth/signin.twig');
    }

    public function postSignIn($request, $response){
        $auth = $this->auth->attempt(
            $request->getParam('email'),
            $request->getParam('password')
        );

        if(!$auth){
            $this->flash->addMessage('error', 'Email ou senha incorretos.');
            return $response->WithRedirect($this->router->pathFor('auth.signin'));
        }

        return $response->WithRedirect($this->router->pathFor('home'));
    }

    public function getSignUp($request, $response){
        return $this->view->render($response, 'auth/signup.twig');
    }

    public function postSignUp($request, $response){

        $validation = $this->validator->validate($request, [
            'nome' => v::noWhitespace()->notEmpty()->alpha(),
            'sobrenome' => v::notEmpty()->alpha(),
            'email' => v::noWhitespace()->notEmpty()->email(),
            'password' => v::noWhitespace()->notEmpty(),
        ]);

        if($validation){
            //return $response->withRedirect($this->router->pathFor('auth.signup'));
            return json_encode($validation);
        }

        $v = Vendedor::create([
            'name' => $request->getParam('nome'),
            'sobrenome' => $request->getParam('sobrenome'),
            'email' => $request->getParam('email'),
            'isadmin' => 1,
            'password' => password_hash($request->getParam('password'), PASSWORD_DEFAULT),
        ]);

        //$this->auth->attempt($user->email, $request->getParam('password'));

        return '{"result":"true"}';

    }
}