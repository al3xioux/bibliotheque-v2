<?php
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'biblio-v2';
    
    //On établit la connexion
    $link = new mysqli($servername, $username, $password, $database);
    mysqli_set_charset($link,"utf8mb4");

    //On vérifie la connexion
    if($link->connect_error){
        die('Erreur : ' .$link->connect_error);
    }
?>