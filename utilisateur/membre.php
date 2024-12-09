<?php 
    $titre = "Admin Biblio";
    $stlsheet = "membre.css";
    require "../header.php";
    require "../connexion_bdd.php";
    session_start();
    $user_card_id = $_SESSION['id'];


    $query = "SELECT * FROM reserve JOIN livre ON reserve.Isbn = livre.Isbn JOIN users ON reserve.card_id = users.card_id JOIN date ON reserve.loanDate = date.loanDate 
              WHERE reserve.card_id = '$user_card_id'";

    $result = mysqli_query($link, $query);

    if (!$result) {
        echo "Erreur lors de l'exécution de la requête : " . mysqli_error($link);
        exit;
    }
?>
<body>
    <main>
        <div class="space"></div>
        <div class="container-slider-wrapper">
            <div class="slider-wrapper">
                <button id="prev-slide" class="slide-button material-symbols-rounded">chevron_left</button>
                <div class="image-list">
                    <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                            $isbn = $row['Isbn'];
                            $url = "http://groupe-a-recette.ipssi-sio.fr/detail_livre.php?b=$isbn";

                            echo '<div class="image-item">';
                            echo '<a href="' . $url . '">';
                            echo '<img src="../cover/' . $isbn . '.jpg" alt="Couverture de livre">';
                            echo '</a>';
                            echo '</div>';
                        }

                        mysqli_free_result($result);
                    ?>
                </div>
                <button id="next-slide" class="slide-button material-symbols-rounded">chevron_right</button>
            </div>
        </div>
        <div class="slider-scrollbar">
            <div class="scrollbar-track">
                <div class="scrollbar-thumb"></div>
            </div>
        </div>
        <script src="../index.js"></script>
        <?php require "../footer.php"; ?>
    </main>
</body>
</html>
