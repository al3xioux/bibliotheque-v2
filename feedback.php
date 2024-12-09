<!DOCTYPE html>
<html lang="en">
<?php require "connexion_bdd.php"; ?>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="feedback.css">
</head>
<body>
    <div class="carousel" data-carousel>
        <div class="carousel-buttons">
            <button class="carousel-button carousel-button_previous" data-carousel-button-previous>
                <span class="fas fa-chevron-circle-left"></span>
            </button>
            <button class="carousel-button carousel-button_next" data-carousel-button-next>
                <span class="fas fa-chevron-circle-right"></span>
            </button>
        </div>
        <div class="slides" data-carousel-slides-container>
            <div class="slide-container">
            <?php
                $isbn_livre = $_GET['b'];
                $sql = "SELECT f.isbn, f.commentaire, f.note, u.Prenom, u.Nom 
                        FROM feedback f 
                        INNER JOIN users u ON f.card_id = u.card_id 
                        WHERE f.isbn = '$isbn_livre'";
                $result = $link->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo '<div class="slide">';
                        echo '<p>Commentaire de ' . $row["Prenom"] . ' ' . $row["Nom"] . '</p><br>';
                        echo '<p>Note : ' . $row["note"] . ' /5</p><br>';
                        echo '<p>' . $row["commentaire"] . '</p>';
                        echo '</div>';
                    }
                } else {
                    echo "<div class='slide'>";
                    echo "Aucun commentaire trouvé pour ce livre.";
                    echo "</div>";
                }
                ?>
            </div>
        </div>
        <div class="feedback-box">
            <form method="post" action="#">
        <label for="commentaire">Commentaire :</label><br>
        <textarea id="commentaire" name="commentaire" rows="5" cols="40"></textarea><br><br>
        <label for="note">Note /5 :</label><br>
        <select id="note" name="note">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select><br><br><br>
        <input type="submit" value="Ajouter commentaire">
    </form>
        </div>
    </div>

    
    <?php require ('ajouter_commentaire.php')?>
    <script src="feedback.js"></script>
</body>
</html>