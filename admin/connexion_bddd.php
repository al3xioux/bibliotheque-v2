<?php
    $conn = mysqli_connect("localhost", "root", "", "biblio-v2");
    if (!$conn){
        echo "Erreur : Impossible de se connecter à MySQL";
        exit;
    }
    
    ?>
