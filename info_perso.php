<?php 
    $stlsheet="style/info_perso.css";
    $titre="Info Personnelle";
    require "header.php";
?>

<main>
    <div class="wrapper">
        <div class="box_a">
            <div class="texte">
                <h1>Réinitialiser mot de passe :</h1>
                <h2>Veuillez saisir les informations</h2>
                <form method="post" action="formulaire_membre.php">
                    <fieldset>
                        <ul>
                            <li class="li_texte">
                                <label>
                                    <span>Card_id</span>
                                    <input type="text" name="identifiant">
                                </label>
                            </li>
                            <li class="li_texte">
                                <label>
                                    <span>Mot de passe actuel</span>
                                    <input type="password" name="ancien_mot_de_passe">
                                </label>
                            </li>
                            <li class="li_texte">
                                <label>
                                    <span>Nouveau mot de passe</span>
                                    <input type="password" name="nouveau_mot_de_passe">
                                </label>
                            </li>
                        </ul>
                    </fieldset>
                    <section >
                        <input class="input_rein" type="submit" value="Réinitialiser mot de passe">
                    </section>
                </form>
            </div>
        </div>
</main>

<script src="index.js"></script>
