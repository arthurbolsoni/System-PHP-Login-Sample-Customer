<?php
namespace App\Models;

use \PDO;
use Illuminate\Database\Eloquent\Model;

class Vendedor extends Model{
 
    // database connection and table name
    protected $table = "vendedor";

    protected $fillable = [
            'id',
            'name',
            'sobrenome',
            'email',
            'isadmin',
            'password',
    ];
    
}