<?php 
    $stlsheet="../style/info_perso.css";
    $titre="Info Personnelle";
    require "../header.php";
?>

<main>
    <div class="wrapper">
        <div class="box_a">
            <div class="texte">
                <h1>Réinitialiser mot de passe :</h1>
                <h2>Veuillez saisir les informations</h2>
                <form method="post" action="formulaire_membre.php">
                    <fieldset>
                        <div class="li_texte">
                            <label>
                                <span>Mot de passe actuel</span>
                                <input type="password" name="ancien_mot_de_passe">
                            </label>
                        </div>
                        <div class="li_texte">
                            <label>
                                <span>Nouveau mot de passe</span>
                                <input type="password" name="nouveau_mot_de_passe">
                            </label>
                        </div>
                        <div class="li_texte">
                            <label>
                                <span>Confirmer le nouveau mot de passe</span>
                                <input type="password" name="conf_nouveau_mot_de_passe">
                            </label>
                        </div>
                    </fieldset>
                    <section >
                        <input class="input_rein" type="submit" value="Réinitialiser mot de passe">
                    </section>
                </form>
            </div>
        </div>
</main>
