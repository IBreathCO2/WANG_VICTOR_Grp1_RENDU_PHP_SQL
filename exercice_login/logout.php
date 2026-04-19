<?php
    session_start(); //demmarre la session on connais maintenant
    session_unset(); //vide toutes les variables de session
    session_destroy(); //detruit completement la session

    header("Location: login.php"); 
    exit;
    //redirige vers login.php et arrete l'éxecution du code
?>