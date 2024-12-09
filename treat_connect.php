<?php session_start();
    // Récupération des données page_connexion.php
    extract($_POST);
    include "connexion_bdd.php";

    // Requête et vérification de corrélation des données dans la BDD
    
    if((isset($id, $pass)) && (($id!="") && ($pass!=""))){
        $rq1 = "SELECT card_id, pass, rang FROM users WHERE card_id=?;";
        $stmt = $link -> prepare($rq1);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $stmt->bind_result($grab_id, $grab_pass, $grab_rang);
        $stmt->fetch();
        $stmt->close();
        if(isset($grab_id)){
            if(password_verify($pass, $grab_pass)){
                echo "Connexion réussie.";
                $_SESSION['perm'] = $grab_rang;
                $_SESSION['id'] = $grab_id;
            }else{
                echo "Mot de passe incorrect.";
            }
        }else{
            echo "Utilisateur introuvable.";
        }

    }else{
        echo "Veuillez renseigner tous les champs.";
    }
?>