<?php

include ('init.php');

if ($_SESSION['admin']) {


  include ('init.php');
  include ('header.php');
  echo '<title>TypeFast - Administrateur</title>';

  echo '
    <div class="content-wrapper">
      <div class="container-fluid">

        <div class="row">
          <div class="col-md-12">
          TOUS LES UTILISATEURS
            </br>';
            $users=User::findAll_User();
            foreach($users as $user){
                echo '<div class="col-md-6" >';
                  echo 'Nom : ' .$user['nom'];
                  echo '</br>';
                  echo 'Prénom : ' .$user['prenom'];
                  echo '</br>';
                  echo 'Adresse e-mail : ' .$user['mail'];
                  echo '</br>';
                  echo 'Login : ' .$user['login'];
                  echo '</br>';
                  echo '</br>';
                echo '</div>';
            }

            echo '

            ';

          echo '
          </div>
        </div>
        <a href="register.php" class="text-dark"> Créer un nouvel utilisateur</a>        
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
  ';
  }
  else
  {
    echo "Vous n'avez pas accès à cette page";
    header('location:user.php');
  }

 ?>
