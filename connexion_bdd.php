<?php
    $servername = 'ipssisqgroupea.mysql.db';
    $username = 'ipssisqgroupea';
    $password = 'N6mT74AmiK9nC7rn';
    $database = 'ipssisqgroupea';
    
    //On établit la connexion
    $link = new mysqli($servername, $username, $password, $database);
    mysqli_set_charset($link,"utf8mb4");

    //On vérifie la connexion
    if($link->connect_error){
        die('Erreur : ' .$link->connect_error);
    }
?>