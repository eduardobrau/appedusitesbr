<?php

class ValidaForm{

	private $input = array();
	private $erro = array();

	public function __construct($dados){
		$this->SetForm($dados);
	}

	public function SetForm($inputForm){
		//print_r($inputForm); die();
		foreach ($inputForm as $key => $value) {
			
			switch ($key) {

				case 'nome':
					$this->ValidaNome($value);
				break;
				
				default:
					# code...
				break;

			}

			$this->input[$key] = $value;

		}

	}	

	public function ValidaNome($nome){

		if( !preg_match("/^[a-zà-ú A-ZÁ-Ù]{3,40}$/" , $nome) ){
      $this->erro[] = "<div class=\"notification_error\">  $nome   inválido  </div>  "; 
    }

	}

	public function getForm(){
		return $this->input;
	}

}

$dados = array(
	'nome'						=>'Eduardo',
	'sexo' 						=> 'Masculino',
	'email'						=> 'mail.com',
	'telefone' 				=> 12202,
	'data_nascimento' => '12'

);

$form = new ValidaForm($dados);
$inputs = $form->getForm();
print_r($inputs);