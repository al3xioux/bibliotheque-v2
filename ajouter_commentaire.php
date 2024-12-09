<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["commentaire"]) &&  isset($_POST["note"])) {
        $isbn = $_GET["b"];
        $commentaire = $_POST["commentaire"];
        $card_id = $_SESSION["id"];
        $note = $_POST["note"];

        require "connexion_bdd.php";

        $sql_check_isbn = "SELECT * FROM livre WHERE Isbn = ?";
        $stmt_check_isbn = $link->prepare($sql_check_isbn);
        $stmt_check_isbn->bind_param("s", $isbn);
        $stmt_check_isbn->execute();
        $result_check_isbn = $stmt_check_isbn->get_result();

        if ($result_check_isbn->num_rows > 0) {
            $sql_insert_comment = "INSERT INTO feedback (card_id, isbn, commentaire, note) VALUES (?, ?, ?, ?)";
            $stmt_insert_comment = $link->prepare($sql_insert_comment);
            $stmt_insert_comment->bind_param("sssi", $card_id, $isbn, $commentaire, $note); 
            if ($stmt_insert_comment->execute()) {
                echo "<script>alert('Commentaire ajouté avec succès !'); window.location.href = 'detail_livre.php?b=$isbn';</script>";
            } else {
                echo "<script>alert('Vous avez déjà rédigé un commentaire !'); window.location.href = 'detail_livre.php?b=$isbn';</script>" . $stmt_insert_comment->error;
            }
            
        } 
        $stmt_check_isbn->close();
        $link->close();
    } else {
        echo "Veuillez fournir l'ISBN, le commentaire, votre ID de carte et la note.";
    }
}
?>
