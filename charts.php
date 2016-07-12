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

						<div id="chartContainer" style="height: 300px; width: 100%;"></div>


          </div>
        </div>
      </div>
    </div>

    <!-- Loading Scripts -->
    <script src="js/jquery.min.js"></script>
		<script src="js/jquery.canvasjs.min.js"></script>
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
	$(function () {

		getUsersHighScores();

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
