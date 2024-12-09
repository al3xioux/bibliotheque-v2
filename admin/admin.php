<?php 
    $titre = "Admin Biblio";
    $stlsheet = "admin.css";
    require "../header.php";
    if($_SESSION['perm']!=1){
        echo "<br><br><br><br><h2 id='perm'>Vous n'avez pas la permission de consulter cette page.<h2>";
        exit();
    }
?>

    <main>
        <div class="wrapper">
            <div class="box_a">
                    <h1>Générer code confidentiel :</h1>
                    <h2>Veuillez saisir vos infos</h2>
                    <form method="post" action="formulaire_admin.php" location="admin.php">
                        <section>

                            <fieldset>
                            <ul>
                                    <li>
                                        <label>
                                            <span>Card_id</span>
                                            <input type="text" name="identifiant">
                                        </label>
                                    </li>
                                </ul>
                            </fieldset>
                            <section>
                            <input type="text" id="code" name="code" readonly>
                            <p><input type="submit" value="Générer code confidentiel" onclick="generercode();"></p>
                            </section>
                        </section>
                    </form>
            </div>
        </div>
    </main>
    <script src="admin.js"></script>



    
    
    <?php require "../deconnexion_bdd.php";?>

</body>
</html>

