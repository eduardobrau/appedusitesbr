<?php

class ValidaForm2{

	private $field;
	private $value;

	public function __construct($field, $value){
		$this->field = $field;
		$this->value = $value;
	}

	public function getField(){
		return $this->field;
	}

	public function getValue(){
		return $this->value;
	}

	public function ValidaNome($nome){

		if( !preg_match("/^[a-zà-ú A-ZÁ-Ù]{3,40}$/" , $nome) ){
      $this->erro[] = "<div class=\"notification_error\">  $nome   inválido  </div>  "; 
    }

	}


}

$dados = array(
	'nome'						=>'Eduardo',
	'sexo' 						=> 'Masculino',
	'email'						=> 'mail.com',
	'telefone' 				=> 12202,
	'data_nascimento' => '12'

);

$form = new ValidaForm2($dados);
$inputs = $form->getForm();
print_r($inputs);