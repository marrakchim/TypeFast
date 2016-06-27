<?php

require 'init.php';

?>


<!doctype html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Inscription - TypeFast</title>

	<!-- Font awesome -->
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<!-- Sandstone Bootstrap CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- Bootstrap Datatables -->
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<!-- Bootstrap social button library -->
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<!-- Bootstrap select -->
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<!-- Bootstrap file input -->
	<link rel="stylesheet" href="css/fileinput.min.css">
	<!-- Awesome Bootstrap checkbox -->
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<!-- Admin Stye -->
	<link rel="stylesheet" href="css/style.css">

	<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

</head>

<body>

	<div class="login-page bk-img" style="background-image: url(img/background.jpg);">
		<div class="form-content">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-md-offset-3">
						<h1 class="text-center text-bold text-dark mt-4x">Inscrivez vous</h1>
						<div class="well row pt-2x pb-3x bk-light">
							<div class="col-md-8 col-md-offset-2">
								<div id="errorDiv"></div>

								<form action=""  class="mt">
									<div class="row" >
										<div class="col-md-6 ">

										<label for="" class="text-uppercase text-sm">Prénom</label>
										<input type="text" id="prenom" placeholder="Prenom" class="form-control mb">

										</div>
										
										<div class="col-md-6 ">

										<label for="" class="text-uppercase text-sm">Nom</label>
										<input type="text" id="nom" placeholder="Nom" class="form-control mb">

										</div>

									</div>

									<label for="" class="text-uppercase text-sm">Adresse e-mail</label>
									<input type="text" id="mail" placeholder="Adresse e-mail" class="form-control mb">

									<label for="" class="text-uppercase text-sm">Login</label>
									<input type="text" id="login" name="pseudo" placeholder="Pseudo" class="form-control mb">

									<div class="row" >
										<div class="col-md-6">

										<label for="" class="text-uppercase text-sm">Mot de passe</label>
										<input type="password" id="password" placeholder="Mot de passe" class="form-control mb">

										</div>

										<div class="col-md-6">

										<label for="" class="text-uppercase text-sm"> Mot de passe</label>
										<input type="password" id="password-check" placeholder="Vérification" class="form-control mb">

										</div>
									</div>

									<button id="registration" class="btn btn-primary btn-block" type="button">Inscription</button>

								</form>
							</div>
						</div>
						<div class="text-center text-light">
							<a href="login.php" class="text-dark"> Ou connectez-vous si vous êtes déjà inscrit !</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Loading Scripts -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>
	<script src="js/controller.js"></script>


	<script>
		$(function(){
			manageRegistration();
		});
	</script>

	<footer></footer>

</body>

</html>
