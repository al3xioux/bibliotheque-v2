<?php
    $stlsheet = "style/style.css";
    $titre = "Connexion";
    require "header.php";
    
?>
<link rel="stylesheet" href="admin/admin.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script type = "text/javascript">
  // Script connexion AJAX

  $(function(){
    $("#connexion_form").submit(function() {

      // Récupération du form et envoi dans treat_connect.php

      id = $(this).find("input[name=id-input]").val();
      pass = $(this).find("input[name=pass-input]").val();
      $.post("treat_connect.php", {id: id, pass: pass}, function(data){

        // Récupération des messages retournés par treat_connect.php

        if((data=="Utilisateur introuvable.") || (data=="Veuillez renseigner tous les champs.") || (data=="Mot de passe incorrect.")){
          $(".reussi").empty().append(data);
        }else if(data=="Connexion réussie."){
          $(location).prop("href", "http://groupe-a-recette.ipssi-sio.fr/index.php");
        }else{
          $(".reussi").empty().append("Un erreur est survenue, contactez le support.");
        }
      });
      return false;
    });
  });
</script>
<div class="post_form">
  <form method="post" class="form" id="connexion_form" action="#">
        <p class="form-title">Se connecter à votre compte : </p>
          <div class="input-container">
            <input placeholder="ID membre" name="id-input" type="text">
        </div>
        <div class="input-container">
            <input placeholder="Mot de passe" name="pass-input" type="password">
            <span>
              <svg stroke="currentColor" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" stroke-width="2" stroke-linejoin="round" stroke-linecap="round"></path>
                <path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" stroke-width="2" stroke-linejoin="round" stroke-linecap="round"></path>
              </svg>
            </span>
          </div>
          <h2 class="reussi" style="color: #DB0000;"></h2>
          <button class="submit" type="submit">
          Se connecter
        </button>

        <p class="signup-link">
          Vous n'avez pas encore de compte ?
          <a href="page_inscription.php">S'inscrire</a>
        </p>
  </form>
</div>