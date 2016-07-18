<?php

include ('init.php');

if (!$_SESSION['admin']) {
  include ('header.php');
?>

<title>TypeFast - <?php echo $_SESSION['login']; ?> </title>

  <div id="container-general" class="content-wrapper">
    <div class="container-fluid">

        <div id="popup-score" class="popup">
          <div class="overflow"></div>
          <div class="row modal-pop">
            <div class="col-md-6 col-md-offset-2">
                <div class="well row pt-3x pb-1x bk-light">
                  <div class="text-center text-dark">
                  <div class="jumbotron">
                    <p>Partie terminée</p>
                    <div id="score"></div>
                    <div class="col-sm-4">
                       <button  class="btn btn-danger"  id="reload">Nouvelle partie</button>
                    </div>
                  </div>
                  </div>
                </div>
            </div>
          </div>
        </div>

        <div id="instructions" class="col-md-8 col-md-offset-1" >
          <h2 >Tapez le plus vite possible ! </h2>
          <h3 class="mb-2x">Vous avez 5 minutes et 3 essais... </h3>

        </div>

        <div class="row">
          <div class="col-md-8 col-md-offset-1">
              <div id="container_jeu" class="well pt-3x pb-1x">
                <div class="row">
                  <div class="col-md-6 col-md-offset-2">
                    <div id="errorDiv"></div>
                    <div id="timer" class="text-center text-dark"></div>
                    <div id="jeu" class="pt-2x pb-2x text-center">  </div>
                    <textarea id="textInput" rows="7" cols="50" class="mt-2x"></textarea>

                    <button id="buttonCheck" class="col-md-8 col-md-offset-3 btn btn-success mt-2x">Verifier</button>
                  </div>
                </div>
              </div>
          </div>
        </div>

        <div id="popup-view" class="popup showMe">
          <div class="overflow"></div>
          <div class="row modal-pop">
            <div class="col-md-6 col-md-offset-2">
                <div class="well row pt-3x pb-1x bk-light">
                  <div class="text-center text-dark">
                  <div class="jumbotron">
                    <h1>Bienvenue !</h1>
                      <div id="choixPartie">
                        <p>Veuillez choisir une partie </p>

                        <div class="hr-dashed"></div>
                        <div class="form-group">
                          <div class="col-sm-8">
                            <select id="choixJeu" class="form-control">

                            </select>
                          </div>
                          <div class="col-sm-4">
                             <button  class="btn btn-danger"  id="newGame">Nouvelle partie</button>
                          </div>
                        </div>
                         <br>
                      </div>
                  </div>
                  </div>
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
  <script src="js/kinetic-v5.1.0.js"></script>
  <script src="js/main.js"></script>
  <script src="js/timer.jquery.js"></script>
  <script src="js/controller.js"></script>


  <script>
    $(function(){

      // end loading -> fonction : appel controlleur.php -> games.php
      getGameList();

//Gestion du pop up
        $('#newGame').on('click', function(){
              close_popup();
              startGame();
              handleTimer();
        });
    });


    function close_popup(){
        Pblock = $('#popup-view').removeClass('showMe');
    }

  </script>

<?php

}
else
{
  echo "Vous n'avez pas accès à cette page";
  header('location:adminHome.php');
}


?>
