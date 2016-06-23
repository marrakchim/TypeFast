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

    public function user_registration()
    {
      $login = $_POST['login'];
      $password = $_POST['password'];

      $data=[];
      $data["login"]=$login;
      $data["password"]=$password;

      $user = new User;
      $user->create(null,$data);
      echo true;

    }

    public function user_check()
    {
      //if(isset($_POST['login']) && isset($_POST['password'])){
        $login = $_POST['login'];
        $password = $_POST['password'];

      //$user = R::find('user',' login = ? and password = ? ',
      //                  [ $login,$password ]
      //                 );
        $user = User::connect($login,$password);

        if($user!=false)
        {
          try {
            $_SESSION['id'] = $user->id;
            $_SESSION['admin']=  $user->admin;
            $_SESSION['login'] = $user->login;
            $_SESSION['password'] = $user->password;
            //header('Location: index.html');
            echo true;
          } catch (Exception $e) {
            echo "erreur";
          }
        }
      else echo "Login ou mot de passse faux";


    }

}

 ?>
