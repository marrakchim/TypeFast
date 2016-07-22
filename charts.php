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
            <h2 class="page-title">Voir les statistiques</h2>

            <h3>Tous les utilisateurs</h3>


						<div id="highScoreChartContainer" style="height: 300px; width: 100%;"></div>
          </br>

						<div class="row">
		          <div class="col-md-12">
		            </br>

								<form>
									<label for="user">Voir les scores individuels</label><br/>
		                 <select name="user" title="Choisir un utilisateur" data-style="btn-info" show-tick id="user" data-width="150px" class="selectpicker">
		                     <?php
												 $users=User::findAll_User();
												 foreach($users as $user){
													if($user['login']!="admin")
													//Recuperer l'id de l'utilisateur selectionne
				 									echo '<option data-uuid='.$user['id'].'>' .$user['login']. '</option>';
				 		            	}
												 ?>
		                 </select>
								</form>


								<div id="scoreContainer" style="height: 300px; width: 100%;"></div>


		          </div>

          </div>
        </div>
      </div>
    </div>

    <!-- Loading Scripts -->
    <script src="js/jquery.min.js"></script>
		<script src="js/jquery.canvasjs.min.js"></script>
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
	$(function () {

		getUsersHighScores();
		$('#user').on('change', function() {
			var selection = $("#user").find(":selected").data("uuid");
			createUserScoreChart(selection);
		});


	});

	</script>


<?php
  }

  else
  {
    echo "Vous n'avez pas accès à cette page";
    header('location:userHome.php');
  }

 ?>
