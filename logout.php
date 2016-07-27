<?php

include ('init.php');

// Suppression des variables de session et de la session
session_destroy();


header('location:login.php');

?>

<script>

localStorage.setItem('timer',0);
localStorage.setItem('textInput'," ");
localStorage.setItem('gameStarted',0);
localStorage.setItem('texte'," ");

</script>
