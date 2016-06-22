<?php

 require_once 'rb.php';
 R::setup('mysql:host=127.0.0.1;dbname=FastType','root','');
 R::setAutoResolve( TRUE );        //Recommended as of version 4.2

 /**
USER: id, login, password, timeLogin, admin
MATCH : id, nbTry, idUser, idGame, timePlay, score
GAME : id, text, idUser (img?)
 **/


?>
