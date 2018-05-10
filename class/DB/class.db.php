<?php

class DB{

	private $host = "127.0.0.1:3306";
	private $database = "appedusitesbr";
	private $usuario = "root";
	private $senha = "";
	private $conexao;

	public function __construct(){

		$this->conectar();	

	}

	public function __destruct(){

		$this->conexao;

	}

	private function conectar(){

		$this->conexao = mysqli_connect($this->host, $this->usuario, $this->senha, $this->database);

		if ( !$this->conexao ) {
			die('Não foi possível conectar ao mysql: ' . mysqli_connect_error());
			exit();
		}else{
			return $this->conexao;
		}

	}

	public function consultar($table,$campos=FALSE,$where=FALSE){

		$query = 'SELECT ';

		if( empty($campos) )
			$query.= '*';
		else
		 $query.= $campos;

		$query.= ' FROM ' .'`'.$table.'`';

		if( !empty($where) )
		 $query.= ' WHERE ' .$where;
		
		//die($query);

		$result = mysqli_query($this->conexao,$query);

		if ( !$result ) {
			die('Query invalida: ' . mysqli_error($this->conexao));
		}else{
			//return var_dump( mysqli_fetch_assoc($result) );
			return mysqli_fetch_assoc($result);
		}

	}

	public function insert($table, $datas){
		
		foreach ($datas as $coluna => $valor) {
			$colunas[]= '`'.$coluna.'`';
			$valores[]= '\''.$valor.'\'';
		}

		$colunas = implode(', ' , $colunas);
		$valores = implode(', ', $valores);

		$sql ='INSERT INTO `'.$table.'` ('.$colunas.') VALUES ('.$valores.')'; 
		echo $sql;
	}


}

$db = new DB();

$cliente = $db->consultar('app_name');
var_dump($cliente);
$_POST['cliente'] = array
(
	'cpf' => '930202933', 
  'rg' => '23.098.233-12', 
  'dt_Nasc' => '1979-02-20', 
  'cnh' => '393493332', 
  'nome' => 'Eduardo', 
  'endereco' => 'Rua jdks da liem'
);

//var_dump($_POST['cliente']);
$db->insert('cliente', $_POST['cliente']);
