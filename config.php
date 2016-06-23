<?php

session_start();

 require_once 'rb.php';
 R::setup('mysql:host=127.0.0.1;dbname=FastType','root','toor');
 R::setAutoResolve( TRUE ); //Recommended as of version 4.2

?>
