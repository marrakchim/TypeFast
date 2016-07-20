<?php

include ('init.php');

if ($_SESSION['admin']) {


  include ('header.php');

  ?>
  <title>TypeFast - Administrateur</title>


    <div class="content-wrapper">
      <div class="container-fluid">

        <div class="row">
          <div class="col-md-12">
            <h2 class="page-title">Créer un nouvel utilisateur</h2>
            <div class="well">

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

            </br>

              <button id="registration" class="btn btn-default btn-block" type="button">Nouvel utilisateur</button>

            </form>

          </div>

          </div>
        </div>
      </div>
    </div>

    <!-- Loading Scripts -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap-select.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap.min.js"></script>
    <script src="js/Chart.min.js"></script>
    <script src="js/fileinput.js"></script>
    <script src="js/chartData.js"></script>
    <script src="js/main.js"></script>
    <script src="js/controller.js"></script>

    <script>
  		$(function(){
  			manageRegistration(1);
  		});
  	</script>

<?php
  }

  else
  {
    echo "Vous n'avez pas accès à cette page";
    header('location:user.php');
  }

 ?>
