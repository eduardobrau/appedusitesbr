<?php
	(isset($_GET['AppEnquete'])) ? var_dump($_GET['AppEnquete']['value']) : '';
	require_once 'class/DataBase.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Enquete Edusites</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Main -->
    <link href="css/main.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

    <div id="fb-root"></div>

	  <div id="container" class="container">
	  	<div class="row">
	  		<div class="col-md-12">

			    <div id="bemVindo">
			      <p>Bem-vindo! Obrigado por visitar o aplicativo</p>
			    </div>

			    <form id="appEnquete" action="http://localhost/appedusitesbr/" accept-charset="utf-8" method="get">

				    <div class="panel panel-primary">
						  <!-- Default panel contents -->
						  <div class="panel-heading"><h4>Quanto você pagaria por um site pessoal ou para sua empresa?</h4></div>

						  <div class="panel-body">
						    <p>Tenho visto muitas pessoas se admirarem no orçamento do desenvolvimento de um Site uns achavam que seriam mais caro outros querem mais descontos, mas enfim queria saber de vocês quanto acha justo pagar por um site relativamente simples com gerenciador de conteúdo com as páginas Home, Sobre, Serviços e Contato</p>
						  </div>

						  <!-- List group -->
						  <ul class="list-group">
						    <li class="list-group-item">
						    	<div class="radio">
									  <label>
									    <input type="radio" name="AppEnquete[value]" id="AppEnquete1" value="R$ 100,00 à R$ 500,00" checked>
									    R$ 100,00 à R$ 500,00
									  </label>
									</div>
						    </li>
						    <li class="list-group-item">
						    	<div class="radio">
									  <label>
									    <input type="radio" name="AppEnquete[value]" id="AppEnquete2" value="R$ 500,00 à R$ 800,00">
									    R$ 500,00 à R$ 800,00
									  </label>
									</div>
								</li>
						    <li class="list-group-item">
						    	<div class="radio">
									  <label>
									    <input type="radio" name="AppEnquete[value]" id="AppEnquete3" value="R$ 800,00 à R$ 1200,00">
									    R$ 800,00 à R$ 1200,00
									  </label>
									</div>
								</li>
						    <li class="list-group-item">
						    	<div class="radio">
									  <label>
									    <input type="radio" name="AppEnquete[value]" id="AppEnquete4" value="R$ 1.200,00 à R$ 2.000,00">
									    R$ 1.200,00 à R$ 2.000,00
									  </label>
									</div>
								</li>
						  </ul>
						</div>
						<div id="logon" style="display: none;">
				      <p class="bg-danger">Você não está logado ao aplicativo!! <a href="#" id="login" class="btn btn-success">Quero me registrar!!</a></p>
				    </div>
						<input type="button" id="btnResponse" class="btn btn-primary" name="" value="Responder">
					</form>
					<?php
						/*$db = new DataBase();
						$cliente = $db->consultar('app_name');
						var_dump($cliente);
						$form = array(
							"tag" => ' form id=appEnquete ',
						);
						echo json_encode($form);*/
					?>
			  </div>
		  </div>
		</div>

		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery-1.9.1.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
		<script src="js/main-script.js"></script>
	</body>
</html>
