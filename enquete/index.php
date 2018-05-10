<?php

include '../include/header.php';
include_once '../class/PDODB.php';
include_once '../class/HashId.php';

// if ( isset($_GET['action']) ) {

// 	if( $_GET['action'] === 'create' ){
// 		var_dump($_GET);
// 		$rule['id'] = $_GET['id'];
// 		$rule['description'] = $_GET['description'];

// 		$DB = new DataBase();

// 		$rule['id'] = HashId::hash($rule['id']);
// 		$DB->insert('rule',$rule);
// 	}

// }

 
	$DB = PDODB::getInstance();
	$enquete = $DB->consultar('app_name');

	//var_dump($enquete);
?>

<div class="container">
	<div class="row">

		<div class="col-md-12">

		  <h2>Lista de Enquetes</h2>
		  <a class="btn btn-success" href="/appedusitesbr/enquete/create.php">Criar Enquete</a>
		  <?php
		  	//var_dump($enquete);	  	
		  			  	
		  	// foreach($enquete as $key => $array) { 
		  	// 	// $tabela['th'][$key] = $key;
		  	// 	// $tabela['td'][$key] = $value;
		  	// 	foreach ($array as $fields => $value) {
		  	// 		$tabela[$key]['th'][$fields] = $fields;
		  	// 		$tabela[$key]['td'][$fields] = $value;
		  	// 	}
		  	// }
		  	
		  	//echo $table;
		  	//var_dump($tabela);
		  	$table = "<table class=\"table table-responsive table-striped\">";
		  	$table .= "<thead>";
		  	
		  	$table .= "<tr>";
		  	//$table .= "<th>ID</th>";
		  	$table .= "<th>Nome</th>";
		  	$table .= "<th>Data de Registro</th>";
		  	$table .= "<th>Data de Validade</th>";
		  	$table .= "<th>Ações</th>";
		  	$table .= "</thead>";
		  	$table .= "</tr>";

		  	
		  	// foreach ($tabela[$key]['td'] as $td) {
		  	// 	$table .= "<td>" .$td. "</td>";
		  	// }
		  	for( $i=0; $i < count($enquete); $i++) {
		  		$table .= "<tr>"; 
		  		//$table .= "<td>" .$enquete[$i]['id']. "</td>";
		  		$table .= "<td>" .$enquete[$i]['name']. "</td>";
		  		//$table .= "<td>" .$enquete[$i]['description']. "</td>";
		  		$table .= "<td>" .$enquete[$i]['app_registered']. "</td>";
		  		$table .= "<td>" .$enquete[$i]['app_validation']. "</td>";
		  		$table .= "<td>";
		  		$table .= "<a class=\"btn btn-xs btn-success\" href='/appedusitesbr/enquete/view.php?id=".$enquete[$i]['id']."'><span class='fa fa-eye'></span></a>";
		  		$table .= "<a class=\"btn btn-xs btn-warning\" href='/appedusitesbr/enquete/edit.php?id=".$enquete[$i]['id']."'><span class='fa fa-pencil'></span></a>";
		  		$table .= "<a class=\"btn btn-xs btn-danger delete\" href='#' data-id=\"".$enquete[$i]['id']."\" data-title=\"".$enquete[$i]['title']."\"><span class='fa fa-trash'></span></a>";
		  		$table .="</td>";
		  		$table .= "</tr>";
		  	}
		  	

		  	$table .= "</table>";
		  	echo $table;
		  ?>
		  
		</div>

	</div>
</div>

<?php
	include '../include/modal.php';
	include '../include/footer.php';
?>