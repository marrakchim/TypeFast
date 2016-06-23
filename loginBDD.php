<?php

  session_start();
  include('init.php');



  $login = $_POST["pseudo"];
  $password = $_POST["mdp"];


/*
  echo $login;
  echo $password;

  $pages = R::find('user',' login = ? and password = ? ',
                  [ $login,$password ]
                 );

var_dump($pages);
  $user = R::findOne('user',
       ' login = :login AND password= :password',
           array(
               ':login' => $login,
               ':password' => $password
           )
       );

  echo $user->id;
  echo $user->admin;

  if($user)
  {
    $_SESSION['id'] = $user->id;
    $_SESSION['admin']=  $user->admin;
    $_SESSION['login'] = $user->login;
    $_SESSION['password'] = $user->password;;

    header('Location: index.html');
  }
  else echo "erreur";
*/
?>
