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
    }

}


Class Controller{


    /***********************************************************************************************/

    public function game_start_game()
    {

       $resultat = Match::create($_POST['userID'],$_POST['matchID']);
       $game = Game::findOneById($_POST['matchID']);
       //var_dump($resultat);

       if ($resultat != false) {
           echo Controller::json_success($game);
       }else {
           echo Controller::json_error("Impossible de créer le match");
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
              //header('Location: index.html');
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


  /*      public function json_array_success($resultat){
            $resultA = [];

            if (!count($resultat)) die ('empty');
            $array = array();
            foreach ($resultat as $key => $bean) {
            $array[] = json_decode($bean, true);
            }

            $resultA['status'] = "success";
            $resultA['response'] = $array;

            return json_encode($resultA);
        }
*/

    public function json_error($message){
        $resultA = [];
        $resultA['status'] = "error";
        $resultA['response'] = $message;
        return json_encode($resultA);
    }



}

?>
