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
            </br>

            <!-- Zero Configuration Table -->
            <div  class="panel panel-default">
              <div class="panel-heading">Tous les utilisateurs</div>
              <div class="panel-body">
                <table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>Nom</th>
                      <th>Prénom</th>
                      <th>Adresse e-mail</th>
                      <th>Login</th>
                      <th>Admin</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Nom</th>
                      <th>Prénom</th>
                      <th>Adresse e-mail</th>
                      <th>Login</th>
                      <th>Admin</th>
                    </tr>
                  </tfoot>
                  <tbody>
                  <?php $users=User::findAll_User();
                    foreach($users as $user){
                      echo '<tr>';
                      echo '<td>' .$user['nom']. '</td>';
                      echo '<td>' .$user['prenom']. '</td>';
                      echo '<td>' .$user['mail']. '</td>';
                      echo '<td>' .$user['login']. '</td>';
                      echo '<td>' .$user['admin']. '</td>';
                      echo '</tr>';
                    }
                  ?>

                  </tbody>
                </table>

              </div>
            </div>

        <div class="row">
          <div class="col-md-12">

            <!-- Zero Configuration Table -->
            <div  class="panel panel-default">
              <div class="panel-heading">Tous les jeux </div>
              <div class="panel-body">
                <table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>Titre</th>
                      <th>Texte</th>
                      <th>Difficulté</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Titre</th>
                      <th>Texte</th>
                      <th>Difficulté</th>
                    </tr>
                  </tfoot>
                  <tbody>
                  <?php $games=Game::findAll_Games();
                    foreach($games as $game){
                      echo '<tr>';
                        echo '<td>' .$game['label']. '</td>';
                        echo '<td>' .$game['text']. '</td>';
                        echo '<td>' .$game['difficulty']. '</td>';
                      echo '</tr>';
                    }
                  ?>
                  </tbody>
                </table>



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
<?php
  }

  else
  {
    echo "Vous n'avez pas accès à cette page";
    header('location:userHome.php');
  }

 ?>
