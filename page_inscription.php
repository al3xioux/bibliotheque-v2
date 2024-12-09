<?php
    $stlsheet = "style/style.css";
    $titre = "Connexion";
    require "header.php";
    
?>
<link rel="stylesheet" href="admin/admin.css">
<div class="post_form">
  <form method="post" class="form2" id="inscription_form" action="treat_inscription.php">
        <p class="form-title">Se connecter à votre compte : </p>
          <div class="input-container">
            <input placeholder="ID carte" name="id-input" type="text">
        </div>
        <div class="input-container">
            <input placeholder="Code confidentiel" name="code-input" type="text">
        </div>
        <div class="input-container">
            <input placeholder="Nom" name="nom-input" type="text">
        </div>
        <div class="input-container">
            <input placeholder="Prénom" name="prenom-input" type="text">
        </div>
        <div class="input-container">
            <input placeholder="E-mail" name="mail-input" type="email">
        </div>
        <div class="input-container">
            <input placeholder="Choisir un mot de passe" name="pass-create" type="password">
            <span>
              <svg stroke="currentColor" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" stroke-width="2" stroke-linejoin="round" stroke-linecap="round"></path>
                <path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" stroke-width="2" stroke-linejoin="round" stroke-linecap="round"></path>
              </svg>
            </span>
          </div>
          <div class="input-container">
            <input placeholder="Confirmer le mot de passe" name="pass-check" type="password">
            <span>
              <svg stroke="currentColor" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" stroke-width="2" stroke-linejoin="round" stroke-linecap="round"></path>
                <path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" stroke-width="2" stroke-linejoin="round" stroke-linecap="round"></path>
              </svg>
            </span>
          </div>
          <h2 id="msg" style="color: #DB0000;"></h2>
          <button class="submit" id="btnSubmit" type="submit">
          S'inscrire
        </button>

        <p class="signup-link">
          Vous avez déjà un compte ?
          <a href="page_connexion.php">Se connecter</a>
        </p>
  </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script type="text/javascript">
  $(document).ready( function() {

      /*@ Registration start */
      $('#btnSubmit').click( function(e) {
          e.preventDefault();

          let formData = $('#inscription_form').serialize();

          $.ajax({
              method: 'POST',
              url: 'treat_inscription.php',
              data: formData,
              statusCode: {
                200: function (response) {
                  console.log(response);
                  let str = "";
                  let add = false;
                  for (let i = 0; i < response.length; i++) {
                      if (response.charAt(i) == "{")
                      {
                        str += response.charAt(i);
                        add = true;
                      }
                      else if (response.charAt(i) == "}")
                      {
                        str += response.charAt(i);
                        add = false;
                      }
                      else
                      {
                        if (add)
                        {
                          str += response.charAt(i);
                        }
                      }
                  }
                  let res = JSON.parse(str);

                  $('#msg').removeClass('alert-danger');
                  $('#msg').addClass('alert-success');
                  $('#msg').html(res.msg);
                  $('#msg').show();
                  $(location).prop("href", "http://groupe-a-recette.ipssi-sio.fr/succes.php");
                },
                406: function (response) {
                    let res = JSON.parse(response.responseText);

                    $('#msg').addClass('alert-danger');
                    $('#msg').removeClass('alert-success');
                    $('#msg').html(res.msg);
                    $('#msg').show();
                },
              },
          });
      });

  });
</script>