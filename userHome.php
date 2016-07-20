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
                  </br>
                    <button  class="btn btn-danger"  id="reload">Nouvelle partie</button>
                  </div>
                  </div>
                </div>
            </div>
          </div>
        </div>



        <div id="popup-instructions" class="popup">
          <div class="row modal-pop">
            <div class="col-md-6 col-md-offset-2">
                <div class=" row bk-light">
                  <div class="text-center text-dark">
                  <div class="jumbotron">

                    <h1>Instructions</h1>
                      <div id="informations" class="mb-3x mt-2x text-justify">
                        <h5>
                        Vous disposez de 3 essais maximum étalés sur 2 heures.</br></br>

                        Il y a un compte à rebours pour chaque essai, limitant la durée de jeu à 5 minutes.</br></br>

                        Le calcul des scores se fait de cette manière :</br></br>

                        - Score maximal 100 points</br></br>
                        - Chaque erreur tapée réduit le score de 0.5 point.</br></br>
                        - Chaque mot manquant réduit le score de 0.5 point.</br></br>
                        </h5>

                        <button  class="col-md-6 btn btn-info"  id="gotIt">J'ai compris</button>
                        </div>
                        <br>
                      </div>
                  </div>
                  </div>
                </div>
            </div>
          </div>
        </div>

        <div id="title" class="col-md-10 col-md-offset-1" >
          <div class="row">
            <h2 class="mb-2x">TypeFast </h2>
          </div>
        </div>

        <div class="row">
          <div class="col-md-8 col-md-offset-1">
              <div id="container_jeu" class="well pt-3x pb-3x">
                <div class="row">
                  <div class="col-md-10 col-md-offset-10 mb-2x">
                    <button id="btn-instructions" class="btn btn-success btn-md btn-round"><span class="">?</span></button>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-10 col-md-offset-3 ">
                    <div class="row mb-2x">
                      <div class="col-md-4 text-center ">
                        <p class="text-center text-dark textSize">Temps restant</p>
                      </div>
                      <div class="col-md-4">
                        <div id="timer" class="text-center text-dark"></div>
                      </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6 col-md-offset-3">
                        <div id="jeu" class="text-center"></div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6 col-md-offset-3">
                        <textarea id="textInput"  class="centre mt-2x"></textarea>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6 col-md-offset-3">
                        <button id="buttonCheck" class=" btn btn-info mt-2x">Verifier</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
          </div>
        </div>

        <div id="popup-view" class="popup showMe">
          <div class="overflow"></div>
          <div class="row modal-pop">
            <div class="col-md-6 col-md-offset-3">
                <div class="well row pt-3x pb-1x bk-light">
                  <div class="text-center text-dark">
                  <div class="jumbotron">
                    <h1>TypeFast</h1>
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
                          <div id="essais" class="pt-3x"></div>
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
          startGame();
          handleTimer();
        });

//Clic sur new game -> show instructions
//Clic sur got it -> start game
        $('#gotIt').on('click', function(){
          $('#popup-instructions').removeClass('slideDown');
          $('#container_jeu').show();
          $('#title').show();
          playTimer();
        });

        $('#btn-instructions').on('click',function(){
          $('#popup-instructions').addClass('slideDown');
          pauseTimer();
          $('#container_jeu').hide();
          $('#title').hide();
        });

        $('#reload').on('click', function(){
              location.reload();
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
