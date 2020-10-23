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
class BookMarkController extends Controller{
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
   
    public function addToBookMark($request, $response) {
        $id = $request->getParam('id');

        if($id==null or $id==0){
            return $this->response->withRedirect('/');
        }

        $flag = $request->getParam('flag') == "true" ? 1 : 0;

        $cliente = Cliente::where('vendedorid', '=', $this->container->auth->vendedorid())
            ->find($id)
            ->update(['flag' => $flag]);  

        if($cliente){
            echo "true";
        }else
        {
            echo "false";
        };
    }
    
    public function bookMark($request, $response, $args) {
        $page = isset( $args['page']) ?  $args['page'] : 1;
        
        // set number of records per page
        $results_per_page = 10;
        // calculate for the query LIMIT clause
        $from_record_num = ($results_per_page * $page) - $results_per_page;

        $clientes = Cliente::where('vendedorid', '=', $this->container->auth->vendedorid())
            ->where('flag', '=', '1')
            ->orderBy('created', 'desc')
            ->offset($from_record_num) //pula x
            ->limit($results_per_page) //pega os proximos y
            ->get();
            
        $rowCount = $clientes->count();

        $total_rows = Cliente::select('id')
            ->where('vendedorid', '=', $this->container->auth->vendedorid())
            ->where('flag', '=', '1')
            ->get()
            ->count();
    
        $cliente_arr=array();
        $cliente_arr['clientes'] = $clientes;
        $cliente_arr['rowCount'] = $rowCount; //total de linhas retornada na pesquisa
        $cliente_arr['total_rows'] = $total_rows; //total de linhas no banco
        $cliente_arr['page'] = $page; //quantidade de paginas 
        $cliente_arr['search_url'] = "/bookmark";
        $cliente_arr['results_per_page'] = $results_per_page;
        
        return $this->view->render($response, 'bookmark.twig', array(
            'content' => $cliente_arr));
    }
}