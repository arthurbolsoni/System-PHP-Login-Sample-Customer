<?php

namespace App\Middleware;

use Slim\Csrf\Guard;

class CsrfMiddleware extends \Twig_Extension{
    protected $guard;
    
    public function __construct(Guard $guard) {
        $this->guard = $guard;
    }

    public function getFunctions() {
        return [
            new \Twig_SimpleFunction('csrf_field',array($this, 'csrfField'))
        ];
    }

    public function csrfField() {
      return '
                <input type="hidden" name="' . $this->guard->getTokenNameKey() .  '"
                    Value="' . $this->guard->getTokenName() . '">
                <input type="hidden" name="' . $this->guard->getTokenValueKey() .  '"
                    Value="' . $this->guard->getTokenValue() . '">
            
           ';
    }
}