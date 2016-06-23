<?php

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
    }

}


Class Controller{


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



    public function user_registration()
    {

      $data=[];
      $data["login"]=$_POST['login'];
      $data["password"]=$_POST['password'];

      $result = User::create(null, $data);
      if ($result != false) {
          echo Controller::json_success($result);
      }else {
          echo Controller::json_error("Impossible de créer le compte");
      }

    }

    public function user_check()
    {
      
      $login = $_POST['login'];
      $password = $_POST['password'];

      
      $user = User::connect($login,$password);

      if($user != false)
      {
        try {
          $_SESSION['id'] = $user->id;
          $_SESSION['admin']=  $user->admin;
          $_SESSION['login'] = $user->login;
          $_SESSION['password'] = $user->password;
          echo Controller::json_success($user);
        } catch (Exception $e) {
          echo Controller::json_error("Impossible de se connecter");
        }
      }else {
        echo Controller::json_error("Login ou mot de passe incorrecte");
      } 
        


    }

}

 ?>
