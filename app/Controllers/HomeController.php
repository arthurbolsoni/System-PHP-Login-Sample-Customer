<?php
namespace App\Controllers;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

use \App\Database;
use \App\Controller\Auth\Auth;
use \App\Models\Vendedor;
use \App\Models\Cliente;
use Slim\Views\Twig as View;

/**
 * Controller de Exemplo
 */
class HomeController extends Controller{

    public function homePage($request, $response){

        $cliente = Cliente::where('name', 'maria')->first();

        var_dump($cliente);


        die();
        return $this->view->render($response, 'home.twig');
    }
   
    public function Home($request, $response, $args) {
        $page = isset( $args['page']) ?  $args['page'] : 1;
        
        // set number of records per page
        $results_per_page = 5;
        // calculate for the query LIMIT clause
        $from_record_num = ($results_per_page * $page) - $results_per_page;

        $vendedorid = $_SESSION['vendedor'];

        $clientes = Cliente::where('vendedorid', '=', $vendedorid)
            ->orderBy('created', 'desc')
            ->offset($from_record_num) //pula x
            ->limit($results_per_page) //pega os proximos y
            ->get();
            
        $rowCount = $clientes->count();
        $total_rows = Cliente::select('id')->where('vendedorid', '=', $vendedorid)->get()->count();

        $cliente_arr=array();
        $cliente_arr['clientes'] = $clientes;
        $cliente_arr['rowCount'] = $rowCount; //total de linhas retornada na pesquisa
        $cliente_arr['total_rows'] = $total_rows; //total de linhas no banco
        $cliente_arr['page'] = $page; //pagina atual
        $cliente_arr['search_url'] = '/'; //url da pesquisa
        $cliente_arr['results_per_page'] = $results_per_page;
        
        return $this->view->render($response, 'home.twig', array(
            'content' => $cliente_arr));
            
        die();
        // Render index view
        return $this->container->get('renderer')->render($response, 'paging.php', [
            'content' => $cliente_arr
        ]);
    }

    public function searchByQuery($request, $response) {
        $params = $request->getQueryParams();
        
        $query = isset($params['query']) ?  $params['query'] : null;
        $type = isset($params['type']) ?  $params['type'] : null;
        $page = isset( $params['page']) ?  $params['page'] : 1;

        // set number of results per page
        $results_per_page = 10;
        // calculate for the query LIMIT clause
        $from_record_num = ($results_per_page * $page) - $results_per_page;
        
        $vendedorid = $_SESSION['vendedor'];    

        $clientes = Cliente::where('vendedorid', '=', $vendedorid)->where(function($q) use ($type, $query)
        {
            switch($type)
            {
                case "query":
                    //$query = "WHERE p.observacao LIKE :query OR p.produto LIKE :query";
                    $q->where('produto', 'LIKE', '%' . $query . '%')->orWhere('observacao', 'LIKE', '%' . $query . '%')->orWhere('name', 'LIKE', '%' . $query . '%');
                    break;
                case "desconto":
                    //$query = " WHERE p.desconto <= :query";
                    $q->where('desconto', '<=', $query);
                break;
                case "produto_obs":
                    //$query = "WHERE p.observacao LIKE :query OR p.produto LIKE :query";
                    $q->where('produto', 'LIKE', '%' . $query . '%')->orWhere('observacao', 'LIKE', '%' . $query . '%')->orWhere('name', 'LIKE', '%' . $query . '%');
                    break;
                case "telefone":
                    //$query = "WHERE p.telefone = :query";
                    $q->where('telefone', '=', $query);
                    break;
                case "nome":
                    $q->where('name', 'LIKE', '%' . $query . '%');
                    break;
            }    
        })->get();
            
        $rowCount = $clientes->count();
        $total_rows = Cliente::select('id')->where('vendedorid', '=', $vendedorid)->get()->count();

        $cliente_arr=array();
        $cliente_arr['clientes'] = $clientes;
        $cliente_arr['rowCount'] = $rowCount; //total de linhas retornada na pesquisa
        $cliente_arr['total_rows'] = $total_rows; //total de linhas no banco
        $cliente_arr['page'] = $page; //quantidade de paginas 
        $cliente_arr['search_url'] = "/searchcliente?type=" . $type . "&query=" . $query. "&page="; //url da pesquisa
        $cliente_arr['results_per_page'] = $results_per_page;
        
        return $this->view->render($response, 'home.twig', array(
            'content' => $cliente_arr,
            'request' => $params));
    }
}