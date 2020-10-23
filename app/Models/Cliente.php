<?php
namespace App\Models;
use \PDO;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model{

    protected $table = "cliente";
    
    protected $fillable = [
        'id',
        'name',
        'alertdate',
        'valordesejado',
        'desconto',
        'telefone',
        'observacao',
        'flag',
        'vendedorid',
        'produto',
        'created',
    ];
 
    // // constructor with $db as database connection
    // public function __construct($db = null){
    //     $this->conn = $db;
    // }
        
    // public function countAll_BySearch($search_term,$type){
    
    //     // select query
    //     $query = "SELECT
    //                 COUNT(*) as total_rows
    //             FROM
    //                 " . $this->table . " p
    //             WHERE
    //                 p.name LIKE ?";
    
    //     // prepare query statement
    //     $stmt = $this->conn->prepare( $query );
    
    //     // bind variable values
    //     $search_term = "%{$search_term}%";
    //     $stmt->bindParam(1, $search_term);
    
    //     $stmt->execute();
    //     $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    //     return $row['total_rows'];
    // }

    //     // used for paging produtos
    // public function countAll(){
    
    //     $query = "SELECT id FROM " . $this->table . "";
    
    //     $stmt = $this->conn->prepare( $query );
    //     $stmt->execute();
    
    //     $num = $stmt->rowCount();
    
    //     return $num;
    //     }
        
    //     // read produtos by search term
    // public function search($search_term, $typequery, $from_record_num, $records_per_page){
    //     $search_query = "%$search_term%";

    //     $query = "";
    //     switch($typequery)
    //     {
    //         case "desconto":
    //             $query = " WHERE p.desconto <= :query";
    //             $search_query = "$search_term";
    //             break;
    //         case "produto_obs":
    //             $query = "WHERE p.observacao LIKE :query OR p.produto LIKE :query";
    //             break;
    //         case "telefone":
    //             $query = "WHERE p.telefone = :query";
    //             $search_query = "$search_term";
    //             break;
    //         case "nome":
    //             $query = "WHERE p.name LIKE :query";
    //             break;
    //     }
        
    //     // select query
    //     $query = "SELECT
    //                 p.id, p.name, p.telefone, p.observacao, p.created, p.produto, p.desconto, p.vendedorid
    //             FROM
    //                 " . $this->table . " p
    //                 {$query}
    //             ORDER BY
    //                 p.created DESC";
    
    //     // prepare query statement
    //     $stmt = $this->conn->prepare( $query );
    
    //     // bind variable values
    //     $stmt->bindParam(':query', $search_query);

    //     // execute query
    //     $stmt->execute();
        
    //     $rowCount = $stmt->rowCount();
    //     $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    //     $result_arr=array();
    //     $result_arr['result'] = $result;
    //     $result_arr['rowCount'] = $rowCount; //quantidade de linhas retornadas na pesquisa

    //     return $result_arr;
    // }

    // // read produtos
    // function readAll($from_record_num, $records_per_page){
    
    //     // select all query
    //     $query = "SELECT
    //                 p.id, p.name, p.telefone, p.observacao, p.created, p.produto, p.desconto, p.valordesejado, p.vendedorid
    //             FROM
    //                 " . $this->table . " p
    //             ORDER BY
    //                 p.created DESC
    //             LIMIT
    //                 {$from_record_num}, {$records_per_page}";
        
    //     // prepare query statement
    //     $stmt = $this->conn->prepare($query);
    
    //     // execute query
    //     $stmt->execute();
    
    //     $rowCount = $stmt->rowCount();
    //     $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    //     $result_arr=array();
    //     $result_arr['result'] = $result;
    //     $result_arr['rowCount'] = $rowCount; //quantidade de linhas retornadas na pesquisa
        
    //     return $result_arr;
    // }

    // // create produto
    // function create(){
    
    //     // query to insert record
    //     $query = "INSERT INTO
    //                 " . $this->table . "
    //             SET
    //                 name = :name,
    //                 valordesejado = :valordesejado,
    //                 desconto = :desconto,
    //                 telefone = :telefone,
    //                 observacao = :observacao,
    //                 produto = :produto,
    //                 created = :created";
    
    //     // prepare query
    //     $stmt = $this->conn->prepare($query);
    
    //     // sanitize
    //     $this->name=htmlspecialchars(strip_tags($this->name));
    //     $this->desconto=htmlspecialchars(strip_tags($this->desconto));
    //     $this->valordesejado=htmlspecialchars(strip_tags($this->valordesejado));
    //     $this->telefone=htmlspecialchars(strip_tags($this->telefone));
    //     $this->observacao=htmlspecialchars(strip_tags($this->observacao));
    //     $this->produto=htmlspecialchars(strip_tags($this->produto));
    //     $this->created=htmlspecialchars(strip_tags($this->created));
    
    //     // bind values
    //     $stmt->bindParam(":name", $this->name);
    //     $stmt->bindParam(":telefone", $this->telefone);
    //     $stmt->bindParam(":observacao", $this->observacao);
    //     $stmt->bindParam(":desconto", $this->desconto);
    //     $stmt->bindParam(":valordesejado", $this->valordesejado);
    //     $stmt->bindParam(":produto", $this->produto);
    //     $stmt->bindParam(":created", $this->created);
    
    //     // execute query
    //     if($stmt->execute()){
    //         return true;
    //     }
    
    //     return false;   
    // }

    // // used when filling up the update produto form
    // function readOne(){
    
    //     // select all query
    //     $query = "SELECT
    //                 p.id, p.name, p.telefone, p.observacao, p.created, p.produto, p.valordesejado, p.desconto
    //             FROM
    //                 " . $this->table . " p
    //             WHERE
    //                 id = ?";
    
        
    //     $stmt = $this->conn->prepare( $query );
    //     $stmt->bindParam(1, $this->id);
    //     $stmt->execute();
    
    //     return $stmt->fetch(PDO::FETCH_ASSOC);
    // }

    // // update the cliente
    // function update(){
    
    //     // update query
    //     $query = "UPDATE
    //                 " . $this->table . "
    //             SET
    //                 name = :name,
    //                 valordesejado = :valordesejado,
    //                 desconto = :desconto,
    //                 telefone = :telefone,
    //                 observacao = :observacao,
    //                 produto = :produto,
    //                 created = :created
    //             WHERE
    //                 id = :id";
    
    //     // prepare query statement
    //     $stmt = $this->conn->prepare($query);
    
    //     // sanitize
    //     $this->name=htmlspecialchars(strip_tags($this->name));
    //     $this->valordesejado=htmlspecialchars(strip_tags($this->valordesejado));
    //     $this->desconto=htmlspecialchars(strip_tags($this->desconto));
    //     $this->telefone=htmlspecialchars(strip_tags($this->telefone));
    //     $this->observacao=htmlspecialchars(strip_tags($this->observacao));
    //     $this->produto=htmlspecialchars(strip_tags($this->produto));
    //     $this->created=htmlspecialchars(strip_tags($this->created));
    //     $this->id=htmlspecialchars(strip_tags($this->id));
    
    //     // bind new values
    //     $stmt->bindParam(':name', $this->name);
    //     $stmt->bindParam(':telefone', $this->telefone);
    //     $stmt->bindParam(':observacao', $this->observacao);
    //     $stmt->bindParam(':valordesejado', $this->valordesejado);
    //     $stmt->bindParam(':desconto', $this->desconto);
    //     $stmt->bindParam(':produto', $this->produto);
    //     $stmt->bindParam(':created', $this->created);
    //     $stmt->bindParam(':id', $this->id);
    
    //     // execute the query
    //     if($stmt->execute()){
    //         return true;
    //     }
        
    //     return false;
    // }
    // // delete the produto
    // function delete(){
    
    //     // delete query
    //     $query = "DELETE FROM " . $this->table . " WHERE id = ?";
    
    //     // prepare query
    //     $stmt = $this->conn->prepare($query);
    
    //     // sanitize
    //     $this->id=htmlspecialchars(strip_tags($this->id));
    
    //     // bind id of record to delete
    //     $stmt->bindParam(1, $this->id);
    
    //     // execute query
    //     if($stmt->execute()){
    //         return true;
    //     }
    
    //     return false;
        
    // }
}