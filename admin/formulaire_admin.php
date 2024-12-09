<?php
$stlsheet = "admin.css";
require "../header.php";
if($_SESSION['perm']!=1){
    echo "<br><br><br><br><h2 id='perm'>Vous n'avez pas la permission de consulter cette page.<h2>";
    exit();
}

    if (isset($_POST["code"]) && isset($_POST["identifiant"])) {
        $code = $_POST["code"];
        $identifiant = $_POST["identifiant"];

        $sql_insert = "INSERT INTO users (codeConf, card_id) VALUES (?, ?)";
        $stmt_insert = $link->prepare($sql_insert);
        $stmt_insert->bind_param("ss", $code, $identifiant);

        if ($stmt_insert->execute()) {
            echo "<script>alert('Le code a bien été généré !'); window.location.href = 'admin.php';</script>";
        } else {
            echo "Erreur lors de l'ajout du code.";
        }
    }

require "../footer.php";
?>


