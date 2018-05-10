<?php
	ini_set('display_errors',1);

	/*
	Nesta função vamos gerenciar a conexão com um banco de dados, direto
	de nosso arquivo de configuração com informações do banco de dados.
	*/

	class conexao{

		private $config, $conexao;

		public function __construct(){
		   $this->config = array(
		       'host' => '127.0.0.1',
		       'banco' => 'sprint_bike',
		       'usuario' => 'root',
		       'senha' => '12345',
		   );
		   $this->conexao = mysqli_connect($this->config['host'], $this->config['usuario'], $this->config['senha'], $this->config['banco'])
		   or die('Não foi se conectar a essa base de dados!');
		}

		public function __destruct(){
		   $this->conexao;
		}
		/*Nesta função, simplificamos a maneira de consultar
		apenas um dado de uma tabela param string $tabela
		Nome da tabela a ter dados consultados param string
		$campos Quais campos serão selecionados na tabela
		param string $onde Onde os dados serão consultados */
		public function ver($tabela, $campos, $onde){
			// Montamos nossa string SQL
			$query = "SELECT $campos FROM `$tabela`";
			/* Verifica se foi passado uma condição para
			retornar um dado em especifico. e caso foi
			passado a condição a função faz a junção com
			a consulta padrão através da concatenação.
			*/
			if(!empty($onde)) {
			   $query .= " WHERE $onde";
			}
			// Limitamos para apenas 1 resultado
			$query .= " LIMIT 1";
			/* Após montar toda a consulta conforme as
			condições, chama o objeto '$obj->conexao'
			de conexão para abrir uma conexão e em
			seguida executa a consulta com o método
			nativo query($sql) note que foi possível chamar
			o objeto de $this->conexao devido ter sido
			declarado no escopo global e em seguida
			diferenciar a variavel global $conexao das
			variaveis locais como a $query. E assim podendo
			ser chamada em qualquer local da classe em
			seguida chamar o método para executar
			consulta query() equivalente ao método
			mysqli_query($sql)
			e armazenamos a consulta SQL na variavel $consulta */
			$consulta = $this->conexao->query($query);
			/*Guardamos os resultados dentro do array resultados,
			que será retornado para a aplicação*/
			$dados = mysqli_fetch_array($consulta);
			return $dados;
		}

		public function listar($tabela, $campos, $onde = null, $filtro = null, $ordem = null, $limite = null) {
			// Montamos nossa query SQL
			$query = "SELECT $campos FROM `$tabela`";
			// Caso tenhamos um valor de onde selecionar dados, adicionamos a cláusula WHERE
			if(!empty($onde)) {
			$query .= " WHERE $onde";
			}

			// ** Realizando verificações caso nem todos os parâmetros sejam enviados para a função: **
			// Caso tenhamos um valor de como filtrar dados que contenham uma regra,
			// adicionamos a cláusula LIKE
			if(!empty($filtro)) {
			$query .= " LIKE $filtro";
			}
			// Caso tenhamos um valor de como ordenar dados, adicionamos a cláusula ORDER BY
			if(!empty($ordem)) {
				$query .= " ORDER BY $ordem";
			}
			// Caso tenhamos um valor de como limitar os dados consultados, adicionamos
			// a cláusula LIMIT
			if(!empty($limite)) {
			$query .= " LIMIT $limite";
			}
			// Preparamos e executamos nossa query
			//$consulta = mysql_query($query);
			$consulta = $this->conexao->query($query);

			/*Se tivermos resultados para nossa consulta, guardamos os resultados dentro do
			array resultados, que será retornado para a aplicação  */
			if(mysqli_num_rows($consulta) != 0) {
				while($item = mysqli_fetch_array($consulta)) {
					$resultados[] = $item;
				}
				return $resultados;
			}else{
				echo "<h3>Não Existe Resultado Para Esta Consulta</h3>";
			}
		} // Fim da função listar

		function inserir($tabela, $dados){
			/**
			* Para cada chave e valor em nosso array, criamos dois novos arrays.
			* Um com colunas, outro com valores.
			* $valores é um array com os valores a serem inseridos, envolvidos
			* em aspas simples: 'lorem ipsum'. */

			foreach($dados as $coluna => $valor) {
				/* Para cada indice do nosso array $dados, foi acrescentado aspas e atribuido a um novo array
				$colunas[] a fim de construir e inserir as colunas dinamicamente  no banco de dados*/
				$colunas[] = "`$coluna`";
				// Envolvemos o valor em crases para evitar erros na query SQL
				$valores[] = "'$valor'";
			}
			// Inserido a virgula dinamicamente com a função implode() tanto nas colunas quanto nos valores
			$colunas = implode(", ", $colunas);
			$valores = implode(" , ", $valores);
			// Montamos a nossa query com as colunas e valores já tratada anteriormente
			$query = "INSERT INTO `$tabela` ($colunas) VALUES ($valores)";
			//die($query);
			mysql_query($query);

		}

		function alterar($tabela, $onde, $dados) {

			// Pegaremos os valores e campos recebidos no método e os organizaremos
			// de modo que fique mais fácil montar a query logo a seguir

			foreach($dados as $coluna => $valor) {
				$set[] = "`$coluna` = '$valor'";
			}
			// Transformamos nosso array de valores em uma string, separada por vírgulas
			$set = implode(", ", $set);
			// Montamos nossa query SQL
			$query = "UPDATE `$tabela` SET $set WHERE $onde";
			// Preparamos e executamos nossa query
			mysql_query($query);
		}

		function remover($tabela, $onde ) { //verficar com professor
			// Montamos nossa query SQL
			$query = "DELETE FROM `$tabela`";
			// Caso tenhamos um valor de onde deletar dados, adicionamos a cláusula WHERE
			if($onde) {  //(!empty($onde))
				$query .= " WHERE $onde ";
			}
			//Preparamos e executamos nossa query
			mysql_query($query);
		}



	}

	$conectar = new conexao;
	//$sql = "SELECT * FROM `produtos`";
	//$resultado = $conectar->consultar($sql);
	$resultado = $conectar->ver('produtos', "`nome`, `codigo-da-categoria`, `preco`", '');
	echo "<pre>"; var_dump($resultado); echo "</pre>";
	//
	//}

