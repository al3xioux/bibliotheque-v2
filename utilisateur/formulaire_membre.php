<?php
require "../connexion_bdd.php";
session_start();

if (isset($_POST["ancien_mot_de_passe"]) && isset($_POST["nouveau_mot_de_passe"])) {
    $identifiant = $_SESSION['id'];
    $ancien_mot_de_passe = $_POST["ancien_mot_de_passe"];
    $nouveau_mot_de_passe = $_POST["nouveau_mot_de_passe"];
    $conf_nouveau_mot_de_passe = $_POST["conf_nouveau_mot_de_passe"];

    $sql_check_password = "SELECT pass FROM users WHERE card_id = ?;";
    $stmt_check_password = $link->prepare($sql_check_password);
    $stmt_check_password->bind_param("s", $identifiant);
    $stmt_check_password->execute();
    $stmt_check_password->bind_result($grab_pass);
    $stmt_check_password->fetch();
    $stmt_check_password->close();

    if (password_verify($ancien_mot_de_passe, $grab_pass)) {
        if($nouveau_mot_de_passe==$conf_nouveau_mot_de_passe){
            do{
                $hash = password_hash($nouveau_mot_de_passe, PASSWORD_DEFAULT);
            }while(password_needs_rehash($hash, PASSWORD_DEFAULT) || !(password_verify($nouveau_mot_de_passe, $hash)));
            $sql_update_password = "UPDATE users SET pass = ? WHERE card_id = ?";
            $stmt_update_password = $link->prepare($sql_update_password);
            $stmt_update_password->bind_param("ss", $hash, $_SESSION['id']);
            $stmt_update_password->execute();
            $stmt_update_password->close();
            echo "<script>alert('Votre mot de passe a bien été réinitialisé !'); window.location.href = 'info_perso.php';</script>";
        }else{
            echo "<script>alert('Les deux mots de passe ne correspondent pas !'); window.location.href = 'info_perso.php';</script>";
        }
    } else {
        echo "<script>alert('Ancien mot de passe invalide !'); window.location.href = 'info_perso.php';</script>";
    }
} else {
    echo "<script>alert('Tous les champs n'ont pas été remplis !'); window.location.href = 'info_perso.php';</script>";
}
    
$link->close();
       
require "../deconnexion_bdd.php";
?>
