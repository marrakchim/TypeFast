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

          <h2 class="page-title">Entrer un nouveau paragraphe</h2>

          <div class="well">
            <form>
              <textarea cols=20 rows=1 id="inputLabelAdmin"></textarea>
              <textarea cols=40 rows=10 id="inputTextAdmin"></textarea>

              <label for="diff">Difficulté</label><br/>
                 <select name="diff" id="diff">
                     <option value="facile" data-id="1">Facile</option>
                     <option value="moyen" data-id="2">Moyen</option>
                     <option value="difficile" data-id="3">Difficile</option>
                 </select>
              <div id="con"></div>

              </br>
            </form>
            <button id="saveGame">Sauvegarder</button>

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
    <script src="js/kinetic-v5.1.0.js"></script>
    <script src="js/fileinput.js"></script>
    <script src="js/chartData.js"></script>
    <script src="js/main.js"></script>
    <script src="js/conversionImage.js"></script>
    <script src="js/controller.js"></script>
    <script>
    $(function(){

        $('#saveGame').on('click', function(){
            adminNewGame();
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
