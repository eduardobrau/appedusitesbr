<?php

 
/*
 * Passo 1 – Criar arquivo com as Informações do Banco de Dados:
Primeiramente vamos criar as definições/constantes externas com as informações do nosso Banco.
Portanto, crie um arquivo PHP com o nome “config.php” ou outro nome de sua preferência  e adicione o seguinte conteúdo:
 */

    // Preencha de acordo com as informações reais do seu banco
    define("SERVIDOR","localhost"); // Servidor do Banco de Dados
    define("USUARIO","root"); // Usuário do Banco de Dados
    define("SENHA","10101010"); // Senha do Banco de Dados
    define("BANCO","banco_teste"); // Nome do Banco de Dados
    
    
    /*
     * Passo 2 – Criar arquivo com o Código PHP da Classe de conexão:

Crie um arquivo com o nome ”class.conexao.php” ou com outro nome de sua preferência e adicione o código abaixo (Class Conexao).
     */
    
include "config.php";
 
class Conexao{
 
protected $conexao, $qry, $sql, $res, $bd;
 
// Realizando a conexão ao Banco de Dados pelo método __construct do PHP (tipo auto executável).
public function __construct() {
 
    // Setando os dados do banco, conforme arquivo "config.php"
    $this->conexao = @mysqli_connect(SERVIDOR,USUARIO,SENHA,BANCO) or die('Não conseguiu conectar');
 
    // Setando o tipo de codificação de caracteres
    $charset   = @mysqli_set_charset($this->conexao, 'utf8');
 
}
 
// Fechando a query e a desconexão ao Banco de Dados pelo método __destruct do PHP (tipo auto executável).
public function __destruct() {
 
    @mysqli_free_result($this->qry);
    @mysqli_close($this->conexao);
 
 }
 
public function Dados(){
 
    // Retorna os dados (campos vindos do select) da consulta
    $this->res = @mysqli_fetch_object($this->qry);
    return $this->res;
 
}
 
public function Qtde() {
 
    // Retorna a quantidade de registros da consulta
    return @mysqli_num_rows($this->qry);
 
}
 
public function ExecSQL() {
 
   // Executa a query no banco de dados
    $this->qry = @mysqli_query($this->conexao,$this->sql);
    return $this->qry;
 
}
 
}
 
?>

