<?php
namespace App\Controllers;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Respect\Validation\Validator as v;

use \App\Database;
use \App\Models\Cliente;

/**
 * Controller de Exemplo
 */
class ClienteController extends Controller{
    /**
     * Container - Ele recebe uma instancia de um 
     * container da rota no construtor
     * @var object s
     */
   protected $container;
   
   /**
    * Método Construtor 
    * @param ContainerInterface $container
    */
   public function __construct($container) {
       $this->container = $container;
    }
   
    public function createCliente($request, $response) {
        
        return $this->view->render($response, 'create_cliente.twig');

        // Render index view
        return $this->container->get('renderer')->render($response, 'create_cliente.phtml');
    }
    
    public function readCliente($request, $response, $args) {
        $id = isset($args['id']) ? $args['id'] : 0;
        
        if($id==0){
            return $this->response->withRedirect('/');
        }
        
        $cliente = Cliente::where('vendedorid', '=', $this->container->auth->vendedorid())
            ->where('id', '=', $id)
            ->get();

        // Render index view
        
        return $this->view->render($response, 'read_cliente.twig', array(
            'content' => $cliente[0]));
        
            die();
        return $this->container->get('renderer')->render($response, 'read_cliente.phtml', [
            'content' => $stmt
        ]);
    }
   
    public function updateCliente($request, $response, $args) {
        $id = isset($args['id']) ? $args['id'] : die('ERROR: missing ID.');
        
        $isupdated = false;

        // get database connection
        $database = new Database();
        $db = $database->getConnection();
        
        // pass connection to objects
        $cliente = new cliente($db);

        // set ID property of produto to be edited
        $cliente->id = $id;
        
        // read the details of produto to be edited
        $stmt = $cliente->readOne();
        
        $content_arr=array();
        $content_arr['cliente'] = $stmt;
        $content_arr['isUpdated'] = $isupdated;

        // Render index view
        
        return $this->view->render($response, 'update_cliente.twig', array(
            'content' => $content_arr));

        return $this->container->get('renderer')->render($response, 'update_cliente.phtml', [
            'content' => $content_arr
        ]);
    }
   
    public function setUpdateCliente($request, $response, $args) {
        $validation = $this->validator->validate($request, [
            'name' => v::notEmpty()->alpha(),
            'valordesejado' => v::optional(v::digit()),
            'desconto' => v::optional(v::digit()),
            'telefone' => v::phone(),
            'observacao' => v::notEmpty(),
            'produto' => v::notEmpty(),
            //'data' => v::noWhitespace()->date()->validate('now'),
        ]);

        if($validation){
            //return $response->withRedirect($this->router->pathFor('auth.signup'));
            return json_encode($validation);
        }

        $c = Cliente::find($request->getParam('id'))->update([
            'name' => $request->getParam('name'),
            'alertdate' => $request->getParam('alertdate'),
            'valordesejado' => $request->getParam('valordesejado'),
            'desconto' => $request->getParam('desconto'),
            'telefone' => $request->getParam('telefone'),
            'observacao' => $request->getParam('observacao'),
            'produto' => $request->getParam('produto'),
            'created' => $request->getParam('created'),
        ]);

        if($c){
            echo "true";
        }else
        {
            echo "false";
        };
    }
   
    public function setCreateCliente($request, $response, $args) {
        $data = $request->getParsedBody();
        
        $validation = $this->validator->validate($request, [
            'name' => v::notEmpty()->alpha(),
            'valordesejado' => v::optional(v::digit()),
            'desconto' => v::optional(v::digit()),
            'telefone' => v::phone(),
            'observacao' => v::notEmpty(),
            'produto' => v::notEmpty(),
            //'data' => v::noWhitespace()->date()->validate('now'),
        ]);

        if($validation){
            //return $response->withRedirect($this->router->pathFor('auth.signup'));
            return json_encode($validation);
        }

        $v = Cliente::create([
            'name' => $request->getParam('name'),
            'valordesejado' => $request->getParam('valordesejado'),
            'desconto' => $request->getParam('desconto'),
            'telefone' => $request->getParam('telefone'),
            'observacao' => $request->getParam('observacao'),
            'flag' => 0,
            'vendedorid' => $this->container->auth->vendedorid(),
            'produto' => $request->getParam('produto'),
            'created' => date('Y-m-d H:i:s'),
        ]);

        if($v){
            echo 'true';
        }else
        {
            echo "false";
        };
    }
}