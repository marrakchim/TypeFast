<?php

include ('init.php');


if (!$_SESSION['admin']) {


include ('header.php');



?>

<title>TypeFast - <?php echo $_SESSION['login']; ?> </title>

  <div class="content-wrapper">
    <div class="container-fluid">

        <div class="row">

          <div class="col-md-12">

              THIS IS THE GAME

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
                    <p>Veuillez choisir une partie </p>

                    <div class="hr-dashed"></div>
                    <div class="form-group">
                      <div class="col-sm-8">
                        <select class="form-control">
                          <option>1</option>
                          <option>2</option>
                          <option>3</option>
                          <option>4</option>
                          <option>5</option>
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

      userID = <?php echo $_SESSION['id']; ?>;

      //newGame(userID);

      //startGame(userID);

      // loading end : fonction : appel controlleur.php -> games.php
      get_game_list();


        $('#newGame').on('click', function(){
              close_popup();
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
