<?php

include '../include/header.php';


if ( isset($_GET['action']) ) {

	
	if( $_GET['action'] === 'create' ){

		//print_r($_GET); die();
		include_once '../class/DataValidator.php';
		include_once '../class/PDODB.php';
		include_once '../class/HashId.php';

		$validate = new DataValidator();
		$validate->define_pattern('error_', '');
		$validate->set('nome', $_GET['name'])->is_required()->min_length(3)
						->set('titulo', $_GET['title'])->is_required()->min_length(10);
		
		if( $validate->validate() ){

			$DB = PDODB::getInstance();
			$_GET['id'] = HashId::hash(date('Y-m-d H:m:s'));
			unset($_GET['action']);

			if( $DB->inserir('app_name', $_GET) ){
				unset($_GET);
			}

		}else{
			$errors = $validate->get_errors();
		}
		

	}

}

?>

<div class="container">
	<div class="row">

		<div class="col-md-12">

		  <h2>Criar Enquete</h2>
		  	<?php 
		  	if(isset($errors)){
		  		foreach ($errors as $array) {
		  			echo '<p class="danger">';
		  			foreach ($array as $erro) {
		  				echo $erro. '</br>';
		  			}
		  			echo '</p>';
		  		}
		  	}else{
		  		//header("Location: create.php");
		  	}
		  	?>
		  <form id="ruleCreate" action="" accept-charset="utf-8" method="GET">

			  <div class="form-group">
			    <label for="name">Nome</label>
			    <input type="text" name="name" class="form-control" id="name" placeholder="Um nome descritivo" maxlength="150" required="required" pattern="[\w\s]+$">
			  </div>
			  <div class="form-group">
			    <label for="name">Titulo</label>
			    <input type="text" name="title" class="form-control" id="title" placeholder="O Titulo que deve aparecer na Enquete" maxlength="150" required="required" pattern="[\w\sà-úÀ-Ú,!?$]+$">
			  </div>
			  <div class="form-group">
			    <label for="description">Descrição</label>
			    <input type="text" name="description" class="form-control" id="description" placeholder="Descrição da Regra" maxlength="255" required="required" pattern="[a-zA-Z0-9à-úÀ-Ú\s\W]+$">
			    <input type="hidden" name="app_registered" class="form-control" id="app_registered" value="<?php echo date('Y-m-d H:m:s')?>">
			  </div>
			  
			  <a class="btn btn-default" href="/appedusitesbr/enquete/index.php"> Voltar </a>
			  <button type="submit" class="btn btn-success" name="action" value="create">Salvar</button>

			</form>
		</div>

	</div>
</div>

<?php
	include '../include/footer.php';
?>