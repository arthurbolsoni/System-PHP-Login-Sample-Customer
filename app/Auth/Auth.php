<?php


namespace App\Auth;

use App\Models\Vendedor;


class Auth
{
    public function vendedorid(Type $var = null)
    {
        return $_SESSION['vendedor'];
    }

    public function vendedor(Type $var = null)
    {
        if(isset($_SESSION['vendedor'])){
            return Vendedor::find($_SESSION['vendedor']);
        }

        return null;
    }

    public function check(Type $var = null)
    {
        return isset($_SESSION['vendedor']);
    }

    public function attempt($email, $password)
    {
        $vendedor = Vendedor::where('email',$email)->first();

        if(!$vendedor){
            return false;
        }

        if(password_verify($password, $vendedor->password)){
            $_SESSION['vendedor'] = $vendedor->id;
            return true;
        }

        return false;
    }
    
    public function logout()
    {
        unset($_SESSION['vendedor']);
    }
}