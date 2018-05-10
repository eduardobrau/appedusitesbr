<?php

include '../include/header.php';
include_once '../class/DataBase.php';
include_once '../class/HashId.php';

if ( isset($_GET['action']) ) {

	if( $_GET['action'] === 'create' ){
		var_dump($_GET);
		$rule['id'] = $_GET['id'];
		$rule['description'] = $_GET['description'];

		$DB = new DataBase();

		$rule['id'] = HashId::hash($rule['id']);
		$DB->insert('rule',$rule);
	}

}

?>

<div class="container">
	<div class="row">

		<div class="col-md-12">

		  <h2>Adicionar Regra</h2>

		  <form id="ruleCreate" action="" accept-charset="utf-8" method="GET">

			  <div class="form-group">
			    <label for="id">ID</label>
			    <!--<input type="hidden" name="action" value="create"> -->
			    <input type="text" name="id" class="form-control" id="id" placeholder="ID da Regra" maxlength="32" required="required" pattern="[a-z0-9]+$">
			  </div>
			  <div class="form-group">
			    <label for="description">Descrição</label>
			    <input type="text" name="description" class="form-control" id="description" placeholder="Descrição da Regra" maxlength="255" required="required" pattern="\w+">
			  </div>
			  
			  <button type="submit" name="action" value="create" class="btn btn-default">Submit</button>

			</form>
		</div>

	</div>
</div>

<?php
	include '../include/footer.php';
?>