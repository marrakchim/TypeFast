<?php

include ('init.php'); 

// Suppression des variables de session et de la session
session_destroy();

header('location:login.php');

?>
