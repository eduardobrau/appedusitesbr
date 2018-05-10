<?php

include '../include/header.php';
include_once '../class/PDODB.php';
include_once '../class/HashId.php';

if ( isset($_GET['id']) ) {

	$DB = PDODB::getInstance();
	// Se usuário existir retorna seu ID
	$appExist = $DB->consultar('app_name', NULL, "`id`='".$_GET['id']."'" );

	//var_dump($appExist);

}

 

?>

<div class="container">
	<div class="row">

		<div class="col-md-12">

			<?php if($appExist){

		  	echo '<h2 class="text-center">' .$appExist[0]['name']. '</h2>';

		  	$table = '<table class="table table-striped table-bordered">';
		  	$table .= '<tbody>';
		  	foreach ($appExist as $key => $valueArray) {
		  		
		  		foreach ($valueArray as $field => $data) {
		  			$table .= '<tr>';
		  			$table .= '<td>' .$field. '</td>';
		  			$table .= '<td>' .$data. '</td>';
		  			$table .= '</tr>';
		  		}
		  		
		  	}

		  	$table .= '</tbody>';
		  	$table .= '</table>';
		  	echo $table;
		  	echo '<a class="btn btn-md btn-success" href="/appedusitesbr/enquete/index.php"> Voltar</a> ';
		  }else{
		  	echo "<p class=\"bg-danger\">Não Existe Esse Dado!</p>";
		  }
		  ?>
			
		</div>

	</div>
</div>


<?php
	include '../include/footer.php';
?>