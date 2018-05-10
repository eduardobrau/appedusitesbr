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

$DB = new DataBase();
$user = $DB->consultar('user');

?>

<div class="container">
	<div class="row">

		<div class="col-md-12">

		  <h2>Lista de Usuários</h2>
		  <?php
		  	//var_dump($user);	  	
		  			  	
		  	foreach($user as $key => $value) { 
		  		$tabela['th'][$key] = $key;
		  		$tabela['td'][$key] = $value;
		  	}
		  	
		  	//echo $table;
		  	//var_dump($tabela);
		  	$table = "<table class=\"table table-striped\">";
		  	$table .= "<thead>";
		  	
		  	$table .= "<tr>";
		  	foreach ($tabela['th'] as $th) {
		  		$table .= "<th>" .$th. "</th>";
		  	}
		  	$table .= "</thead>";
		  	$table .= "</tr>";

		  	$table .= "<tr>";
		  	foreach ($tabela['td'] as $td) {
		  		$table .= "<td>" .$td. "</td>";
		  	}
		  	$table .= "</tr>";

		  	$table .= "</table>";
		  	echo $table;
		  ?>
		  
		</div>

	</div>
</div>

<?php
	include '../include/footer.php';
?>