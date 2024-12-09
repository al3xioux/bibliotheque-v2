<?php
$titre = "Admin Biblio";
$stlsheet = "membre.css";
require "connexion_bdd_json.php";

//Verifcation si c'est une methode POST ou non
// la 2eme partie de la ligne va s'assure qu'un fichier avec le nom de JsonFile existe
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['jsonFile'])) {
    $query_create_table_date = "CREATE TABLE IF NOT EXISTS `date` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `loanDate` DATE
    )";
    if ($link->query($query_create_table_date) === TRUE) {
        echo "La table 'date' a été créée avec succès ou elle existe déjà.<br>";
    } else {
        echo "Erreur lors de la création de la table 'date' : " . $link->error . "<br>";
    }

    $nouvellesReservationsJSON = file_get_contents($_FILES['jsonFile']['tmp_name']);
    $nouvellesReservations = json_decode($nouvellesReservationsJSON, true);

    for($i=0; $i<count($nouvellesReservations); $i++) {
        $isbn = $nouvellesReservations[$i]['isbn']; 
        $card_id = $nouvellesReservations[$i]['card']; 
        $loan_date = $nouvellesReservations[$i]['loan_date'];

        echo $isbn . "<br>";
        echo $card_id . "<br>";
        echo $loan_date . "<br>";

        $rq1 = "INSERT INTO date (loanDate) VALUES ('$loan_date')";
        if ($link->query($rq1) !== TRUE) {
            echo "Erreur lors de l'insertion de la date : " . $link->error . "<br>";
            continue;
        }

        $sql = "INSERT INTO reserve (Isbn, card_id, loanDate) VALUES ('$isbn', '$card_id', '$loan_date')";
        if ($link->query($sql) === TRUE) {
            echo "Nouvelle réservation insérée avec succès !<br>";
        } else {
            echo "Erreur lors de l'insertion de la réservation : " . $link->error . "<br>";
        }
    }
}

require "../footer.php";
?>
