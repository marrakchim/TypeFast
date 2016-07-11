<?php

header('Content-type: application/json');

//Pour afficher les erreurs php
ini_set('display_errors', -2);

require 'init.php';


//Initialisation
$action = "";

//Si l'action est de type GET
if(isset($_GET['action']) && $_GET['action']!= null)
{
  $action = $_GET['action'];


    switch($action)
    {
        case 'game_get_list':
          Controller::game_get_list();
          break;
        case 'game_get_text':
          Controller::game_get_text();
          break;
    }

}


//Si l'action est de type POST
if(isset($_POST['action']) && $_POST['action']!= null)
{
  $action = $_POST['action'];

    switch($action)
    {
      case 'user_registration':
        Controller::user_registration();
        break;
      case 'user_check':
        Controller::user_check();
        break;
      case 'game_start_game':
        Controller::game_start_game();
        break;
      case 'match_update_info':
        Controller::match_update_info();
        break;
    }

}


Class Controller{


    /***********************************************************************************************/

    public function game_get_text()
    {
      $resultat = Game::findOneById($_SESSION['gameID']);
      if($resultat != null) {
        echo Controller::json_success($resultat);
      }
      else echo Controller::json_error("Impossible de récupérer le texte");

    }

    public function game_start_game()
    {
      //Dans tous les cas
      $game = Game::findOneById($_POST['gameID']);
      $resultat=Match::getMatchData($_SESSION['matchID'],"nbTry");

      //Si on ne vient pas de se connecter
      //Si on a déjà joué avant
      if($_SESSION['matchID']!=null)
      {


        if ($resultat<3) {

          $match = Match::create($_SESSION['id'],$_POST['gameID']);

          $_SESSION['matchID'] = $match;
          $_SESSION['gameID']=$_POST['gameID'];

          Match::setMatchData($match,"nbTry",$resultat+1);
          echo Controller::json_success($game);
          }
          else if($resultat==3){
            //Si la difference entre les 2 matchs > 2h il peut rejouer
            // date à tester :
            $now = "2016-07-10 13:52:00";//date('Y-m-d H:i:s');
            $timeStart=Match::getMatchData($_SESSION['matchID'],"timeStart");

            $hourdiff = (strtotime($now) - strtotime($timeStart))/3600;
            if($hourdiff<2)
            {
              echo Controller::json_error("3 essais effectués. Réessayez dans 2 heures.");
            }
            else if($hourdiff>2)
            {
              Match::setMatchData($_SESSION['matchID'],"nbTry",1);
              echo Controller::json_success($game);
            }
        }
        else {
            echo Controller::json_error("Impossible de créer le match");
        }


      //Si c'est la premiere partie
      }else {
        if ($match != null) {
            $_SESSION['matchID'] = $match;
            $_SESSION['gameID']=$_POST['gameID'];
            echo Controller::json_success($game);
        }else {
            echo Controller::json_error("Impossible de créer le match");
        }
      }


    }

    public function game_get_list(){
      //Renvoyer les données sous format de tableau pas objets
      //Manipulation plus évidente en js
      $resultat=R::exportAll(Game::findAll_Games(),true);

      if($resultat!=null)
      {
        echo Controller::json_success($resultat);
      }
      else  echo Controller::json_error("Pas de jeu");

    }
    /***********************************************************************************************/

    public function match_update_info()
    {
      $resultat = Match::findOneById($_SESSION['matchID']);

      if(isset ($_POST['time_played'])) {
        if($resultat!=null)
        {
          Match::setMatchData($resultat->id,"timeEnd", date('Y-m-d H:i:s'));
          Match::setMatchData($resultat->id,"timePlayed",$_POST['time_played']);
          Match::setMatchData($resultat->id,"score",$_POST['score']);

          $resultat = Match::findOneById($_SESSION['matchID']);
          echo Controller::json_success($resultat);
        }

        else  echo Controller::json_error("Pas de jeu");
    }
    else echo Controller::json_error("Erreur isset");

    }


    /***********************************************************************************************/

    public function user_registration()
    {
      if(isset($_POST['login'])&&isset($_POST['password'])&&isset($_POST['nom'])&&isset($_POST['prenom'])&&isset($_POST['mail'])&&isset($_POST['admin']))
      {
        $data=[];
        $data["login"]=$_POST['login'];
        $data["password"]=$_POST['password'];
        $data["nom"]=$_POST['nom'];
        $data["prenom"]=$_POST['prenom'];
        $data["mail"]=$_POST['mail'];
        $data['admin']=$_POST['admin'];


      $result = User::create(null, $data);
      if ($result != false) {
          echo Controller::json_success($result);
      }else {
          echo Controller::json_error("Impossible de créer le compte");
      }
      }
    }

    public function user_check() {

        if(isset($_POST['login']) && isset($_POST['password'])){
          $login = $_POST['login'];
          $password = $_POST['password'];

          $user = User::connect($login,$password);

          if($user!=false)
          {
            try {
              $_SESSION['id'] = $user->id;
              $_SESSION['admin']=  $user->admin;
              $_SESSION['login'] = $user->login;
              $_SESSION['password'] = $user->password;
              $_SESSION['username'] = $user->prenom." ".$user->nom;
              echo Controller::json_success($user);
              } catch (Exception $e) {
              echo Controller::json_error("Impossible de se connecter");
            }
          }else {
              echo Controller::json_error("Login ou mot de passe incorrect");
          }
      }
    }

    /*************************************************************************************************/


    public function json_success($result){
        $resultA = [];
        $resultA['status'] = "success";
        $resultA['response'] = $result;

        return json_encode($resultA);
    }

    public function json_error($message){
        $resultA = [];
        $resultA['status'] = "error";
        $resultA['response'] = $message;
        return json_encode($resultA);
    }
}

?>
