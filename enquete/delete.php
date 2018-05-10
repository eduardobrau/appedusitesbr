<?php

include '../include/header.php';
include_once '../class/PDODB.php';
include_once '../class/HashId.php';

if ( isset($_GET['id']) ) {

	$DB = PDODB::getInstance();
 	// Se usuário existir retorna seu ID
	$appExist = $DB->consultar('app_name', '`id`', "`id`='".$_GET['id']."'" );
	var_dump($_GET['id']);

}

 

?>

<div class="container">
	<div class="row">

		<div class="col-md-12">

			<?php if($appExist){
		  	
				$DB->deletar('app_name', "id='".$_GET['id']."'");
				header("Location: index.php");
						
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