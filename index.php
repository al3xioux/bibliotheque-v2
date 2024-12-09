<?php 
    $titre = "Meaux Biblio";
    $stlsheet = "style/style.css";
    require "header.php";
?>
<body>

    <main>
        <div class="img_biblio">
            <img src="img/range_biblio.jpg">
        </div>
        <?php
            echo '<div class="box-container">';
            $rq1 = "SELECT * FROM livre;";
            $res1 = mysqli_query($link, $rq1);
            $cnt_l =  mysqli_num_rows($res1);

            for ($i=1; $i<=$cnt_l; $i++){
                $row1 = mysqli_fetch_array($res1);

                $rq_a = "SELECT * FROM livre JOIN auteur ON livre.Isbn=auteur.Isbn JOIN personnes ON auteur.id=personnes.id;";
                $res_a = mysqli_query($link, $rq_a);
                $cnt_a = mysqli_num_rows($res_a);

                echo '<div class="grille-item">
                        <div class="box-cov">
                        <a class="lien-livre" href="detail_livre.php?b=' . $row1['Isbn'] .'"><img class="cover" src="cover/'. $row1["Isbn"] . '.jpg" alt="Chargement"></a>
                        </div>
                        <div class="texte">
                            <span class="t1">Titre&nbsp;:&nbsp;' . $row1["Titre"] . '</span><br><br>
                            <span class="t1">Auteur&nbsp;:&nbsp;';
                            for ($j = 1; $j<=$cnt_a; $j++) {
                                $row2 = mysqli_fetch_array($res_a);
                                if ($j>2) {
                                    echo '...';
                                    break;
                                }else {
                                    if ($j == $cnt_a) {
                                        echo $row2["Prenom"] . ' ' . $row2["Nom"];
                                    } else {
                                        echo $row2["Prenom"] . ' ' . $row2["Nom"] . ', ';
                                    }
                                }
                            }
                            echo '</span><br><br>
                            <span class="t1">Date de publication&nbsp;: ' . $row1["Annee"] . '</span><br><br>';
                            
                            $isbn = $row1['Isbn'];
                            $rq_feedback = "SELECT AVG(note) AS moyenne FROM feedback WHERE isbn='$isbn';";
                            $res_feedback = mysqli_query($link, $rq_feedback);
                            $row_feedback = mysqli_fetch_assoc($res_feedback);
                            $moyenne = $row_feedback['moyenne'];
                            
                            echo '<span class="t1 note-box">Moyenne des notes : ';
                            if ($moyenne !== null) {
                                echo round($moyenne, 2) . '/5';
                            }else {
                                echo 'Soit le 1er a écrire un commentaire';
                            }
                            echo '</span><br><br><br>
                        </div>
                      </div>';
            }
            echo '</div>';
        ?>
    </main>
    <?php require "footer.php";?>
</body>