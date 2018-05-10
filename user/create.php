<?php

include_once '../class/DataBase.php';
include_once '../class/HashId.php';

if ( isset($_GET['id']) ) {

	//var_dump($_GET);
	/* 1º passso é validar os dados informado pelo usuário
	* mas como se trata de dados já validados pelo facebook
	* isso não será necessário por enquanto.
	*/
	$user['id'] = $_GET['id'];
	$user['name'] = $_GET['name'];
	$user['email'] = $_GET['email'];
	$response = $_GET['enqueteResponse'];

	$DB = new DataBase();

	//2º passo é cadastrar esse usuário no banco
	$user['id'] = HashId::hash($user['id']);
	// Se usuário existir retorna seu ID
	$userExist = $DB->consultar('user', '`id`', "`id`='".$user['id']."'" );
	//Se usuário não existir retorna NULL então cadastramos ele
	if(!$userExist){
		//var_dump($userExist);
		$DB->insert('user', $user);
	}
	//3º Passo é cadastrar a resposta do usuário no banco

	/* 4º passo é armazenar o usuário em localStorage para
	* informar ao aplicativo que este usuário já participou da
	* enquete e já está cadastrado.
	*/
	$appEdusitesBRuserAdd = array('appEdusitesBRuserAdd' => $user['id']);
	// Distroi os dados do array $user
	unset($user);
	// Retorna as informações no formato Json
	echo json_encode($appEdusitesBRuserAdd);
	
}


