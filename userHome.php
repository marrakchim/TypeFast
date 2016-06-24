<?php

include ('init.php');


if (!$_SESSION['admin']) {


include ('header.php');

?>

<title>TypeFast - <?php echo $_SESSION['login']; ?> </title>

  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-md-offset-3">
              <div class="well row pt-2x pb-3x bk-light">
                <div class="text-center text-dark">
                <div class="jumbotron">
                  <h1>Bienvenue !</h1>
                  <p>This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
                  <p><a class="btn btn-danger btn-lg"  id="newGame">Nouvelle partie</a></p>
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

      startGame(userID);

    });
  </script>



<?php

}
else
{
  echo "Vous n'avez pas accès à cette page";
  header('location:adminHome.php');
}


?>
