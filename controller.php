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
        case 'user_match_get_all_score':
          Controller::user_match_get_all_score();
          break;
        case 'user_match_get_score':
          Controller::user_match_get_score();
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
      case 'game_new_game':
        Controller::game_new_game();
        break;

    }

}


Class Controller{


    /***********************************************************************************************/

    public function game_new_game()
    {
      $label = $_POST['label'];
      $texte = $_POST['texte'];
      $difficulty = $_POST['difficulty'];
      $game=Game::create($label,$texte,$difficulty);

      if($game!=null)
      {
        echo Controller::json_success($game);
      }
      else echo Controller::json_error("Impossible de créer le jeu");
    }

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

      // Si le jeu existe et encore active
      if($game != null && $game->status == 0)
      {

        $lastMatch = Match::findLastOneByUserID_gameID($_SESSION['id'],$_POST['gameID']);

        // Si le joueur a joué déjà une partie du match type gameID
        if ($lastMatch != null)
        {

          // Si le nombre <3
          if ($lastMatch->nbTry < 3) {

              $match = Match::create($_SESSION['id'],$_POST['gameID']);

              $_SESSION['matchID'] = $match;
              $_SESSION['gameID']=$_POST['gameID'];

              Match::setMatchData($match,"nbTry",$lastMatch->nbTry+1);
              echo Controller::json_success($game);

          }else {

            // Si le temps < 2 donc le sys affiche l'erreur "3 essais effectués..."
            // Sinon le joueur peut jouer une partie de plus : donc une de plus chaque 2H

              $now = date('Y-m-d H:i:s');
              $timeStart=$lastMatch->timeStart;
              $hourdiff = (strtotime($now) - strtotime($timeStart))/3600;

              if($hourdiff<2)
              {
                echo Controller::json_error("3 essais effectués. Réessayez dans 2 heures.");
              }else {

                $match = Match::create($_SESSION['id'],$_POST['gameID']);

                $_SESSION['matchID'] = $match;
                $_SESSION['gameID']=$_POST['gameID'];

                Match::setMatchData($match,"nbTry",$lastMatch->nbTry);
                echo Controller::json_success($game);

              }

          }


          // Null : le joueur n'a jamais lancé une partie de type gameID
        }else {

            $match = Match::create($_SESSION['id'],$_POST['gameID']);

            if ($match != null) {
                $_SESSION['matchID'] = $match;
                $_SESSION['gameID']=$_POST['gameID'];
                echo Controller::json_success($game);
            }else {
                echo Controller::json_error("Impossible de créer le match");
            }
        }
        // Deux possibilités : 1- le jeu est fermé par l'admin
        // 2 - Le jeu n'existe pas dans la  base
      }else {
          echo Controller::json_error("Ce jeu n'existe plus."); // fermer par l'admin ou une erreur systeme
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

    public function user_match_get_all_score()
    {
      $users=R::exportAll(User::findAll_User(),true);
      $matches = R::exportAll(Match::findAll_Matches(),true);

      $infos=[];
      $scores=[];

      if($users!=null)
      {
        if($matches!=null)
        {
          foreach($users as $user)
          {
            $login=$user['login'];
              foreach($matches as $match)
              {
                if($user['id'] === $match['id_user'])
                {
                  $scores[]=$match['score'];
                }
              }
              $data=array(
              "score" => $scores,
              "login" => $login
              );
              $infos[]=$data;
              $scores=[];

          }
          echo Controller::json_success($infos);
        }
        else echo Controller::json_error("Pas de matches");
      }
      else  echo Controller::json_error("Pas de user");
    }

    public function user_match_get_score()
    {
      $user_id=$_GET['userID'];

      $user = User::findOneById($user_id);
      $matches = R::exportAll(Match::findAll_Matches(),true);

      $result=[];

      if($user!=null)
      {
        if($matches!=null)
        {
              foreach($matches as $match)
              {
                if($user['id'] === $match['id_user'])
                {
                  $result[]=$match['score'];
                }
              }
          if($result===null) echo Controller::json_error("Cet utilisateur n'a jamais joué.");

          echo Controller::json_success($result);
        }
        else echo Controller::json_error("Pas de matches");
      }
      else  echo Controller::json_error("Pas de user");
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
