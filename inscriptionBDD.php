<?php

  include('init.php');

  $login = $_POST["pseudo"];
  $password = $_POST["mdp"];

  $user = new User;
  $user->create($login,$password);




/*
  $newUser=R::dispense('user');
  $newUser->login=$pseudo;
  $newUser->password=$mdp;
  $newUser->admin=0;
  R::store($newUser);
*/

?>
