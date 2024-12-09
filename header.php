<?php session_start(); ?>
<?php require "connexion_bdd.php";?>
<?php header("Content-type: text/html; charset=utf-8"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?php echo $titre ?> </title>
    <link rel="stylesheet" href=<?php echo  $stlsheet ?>>
    <link rel="stylesheet" href="style/reset.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,0,0">
</head>
        <nav>
            <div class="meauxbiblio">
                <a href="/index.php">
                <img class="logo" src="/img/logo.png" alt="logo">
                <p class="nom">Meaux Biblio</p>
                </a>
            </div>
            <?php
                if(isset($_GET['status'])){
                    if($_GET['status']=='deconnexion'){
                        $_SESSION = array();
                        header('Location: http://groupe-a-recette.ipssi-sio.fr/index.php');
                        exit();
                    }
                }
            
                if(!isset($_SESSION['perm'])){
                    echo "<div class='connexion'>
                            <ul>
                                <li><a href='page_connexion.php' >Se connecter</a>
                                </li>
                            </ul>
                        </div>";
                }else if($_SESSION['perm']==1){
                    echo "<div class='connexion'>
                            <ul>
                                <li><a href='' >Mon compte</a>
                                    <ul class='sub'>
                                        <li><a href='/utilisateur/info_perso.php'>Information personnelle</a></li>
                                        <li><a href='/utilisateur/membre.php'>Historique des livres</a></li>
                                        <li><a href='/admin/admin.php' >Création membre</a></li>
                                        <li><a href='?status=deconnexion'>Déconnexion</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>";
                }else{
                    echo "<div class='connexion'>
                            <ul>
                                <li><a href='' title='Se_connecter'>Mon Compte</a>
                                    <ul class='sub'>
                                        <li><a href='/utilisateur/info_perso.php' title='page1'>Information personnelle</a></li>
                                        <li><a href='/utilisateur/membre.php' title='page2'>Historique des livres</a></li>
                                        <li><a href='?status=deconnexion'>Déconnexion</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>";
                }
            ?>
        </nav>