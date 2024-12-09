<?php
    $stlsheet="style/detail_style.css"; 
    require "header.php";
    $isbn_b = $_GET['b'];
    $row_t = mysqli_fetch_array(mysqli_query($link, "SELECT * FROM livre WHERE Isbn LIKE '$isbn_b';"));
    $titre =  $row_t['Titre'];
?>


<body>

    <?php    
    echo "
        <main>
            <div class='box-all'>";
                

                $rq1 = "SELECT * FROM livre JOIN auteur ON livre.Isbn=auteur.Isbn JOIN personnes ON auteur.id=personnes.id JOIN editeur ON livre.id_Editeur=editeur.id WHERE livre.Isbn LIKE '$isbn_b';";
                $res1 = mysqli_query($link, $rq1);
                $row1 = mysqli_fetch_array($res1);

                $rq2 = "SELECT * FROM livre JOIN auteur ON livre.Isbn=auteur.Isbn JOIN personnes ON auteur.id=personnes.id JOIN editeur ON livre.id_Editeur=editeur.id WHERE livre.Isbn LIKE '$isbn_b';";
                $res2 = mysqli_query($link, $rq2);
                $cnt_a = mysqli_num_rows($res2);

                echo $cnt_a;

                $rq_ge = "SELECT * FROM livre JOIN auteur ON livre.Isbn=auteur.Isbn JOIN personnes ON auteur.id=personnes.id JOIN genre ON livre.id_Genre=genre.id WHERE livre.Isbn LIKE '$isbn_b';";
                $res_ge = mysqli_query($link, $rq_ge);
                $row_ge = mysqli_fetch_array($res_ge);
                
                echo "<div class='box-cov'>
                        <img class='cover' src='cover/" . $row1['Isbn'] . ".jpg' alt='Chargement'>
                        </div>

                <div class='box-texte'>
                    <div class='texte'>
                    <br>
                    <br>
                    <br>
                    <br>
                    
                        <p class='ht'>Titre: " . $row1['Titre'] . "</p>
                        <p class='ht'>Auteur: ";
                        for ($i = 1; $i<=$cnt_a; $i++) {
                            $row2 = mysqli_fetch_array($res2);
                            if ($i==$cnt_a) {
                                echo $row2["Prenom"] . ' ' . $row2["Nom"];
                            }else {
                                echo $row2["Prenom"] . ' ' . $row2["Nom"] . ', ';
                            }
                        }
                        echo "</p>
                        <p class='ht'>Date de publication: " . $row1['Annee'] . "</p>
                        <p class='ht'>Editeur: " . $row1['Libelle'] . "</p>
                        <p class='ht'>ISBN: " . $row1['Isbn'] . "</p>
                        <p class='ht'>Genre: " . $row_ge['Libelle'] . "</p>
                        <p class='ht'>Nb de pages: " . $row1['nbPages'] . "</p>
                        <p class='res'>Résumé: " . $row1['Resume'] . "</p>
                    </div>
                </div>";

                
                    require 'feedback.php';
              ?>
                <?php require 'footer.php'?>   
            </div>
        </main>
        
</body>
</html>
