<?php

include '../include/header.php';
include_once '../class/DataBase.php';
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

 $DB = new DataBase();
 $enquete = $DB->consultar('app_name');

?>

<div class="container">
	<div class="row">

		<div class="col-md-12">

			
		</div>

	</div>
</div>


<?php
	include '../include/footer.php';
?>