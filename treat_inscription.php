<?php
    include "connexion_bdd.php";

    // Reception du $_POST

    $id_card = $_POST['id-input'];
    $code = $_POST['code-input'];
    $nom = $_POST['nom-input'];
    $prenom = $_POST['prenom-input'];
    $mail = $_POST['mail-input'];
    $pass1 = $_POST['pass-create'];
    $pass2 = $_POST['pass-check'];

    // Requête et vérification de corrélation des données dans la BDD
    $errors = "";
    if(empty($id_card) || empty($code) || empty($nom) || empty($prenom) || empty($mail) || empty($pass1) || empty($pass2)){
        $errors .= "<li>Veuillez renseigner toutes les cases.</li>";
    }else{
        $rq1 = "SELECT * FROM users WHERE card_id=?;";
        $stmt1 = $link -> prepare($rq1);
        $stmt1->bind_param("s", $id_card);
        $stmt1->execute();
        $stmt1->bind_result($grab_id, $grab_nom, $grab_prenom, $grab_mail, $grab_pass, $grab_code, $grab_rang);
        $stmt1->fetch();
        $stmt1->close();
        
        if(isset($grab_mail)){
            $errors .= "<li>Un compte existe déjà pour cet utilisateur. Veuillez vous connecter.</li>";
        }
            // Verification que les deux mdp correspondent

        if(!isset($grab_id)){
            $errors .= "<li>Utilisateur introuvable.</li>";
        }
        

        if(!isset($grab_code)){ 
            $errors .= "<li>Votre compte n'a pas été créé, demandez l'édition d'un code confidentiel auprès de votre bibliothéquaire.</li>";
        }

        if($pass1!=$pass2){
            $errors .= "<li>Les deux mots de passes ne correspondent pas.</li>";   
        }
                       
        if($grab_code!=$code){
            $errors .= "<li>Le code confidentiel n'est pas valide.</li>";
            
        }
    }
    
    if(empty($errors)){
        // Chiffrage du mdp et vérification de sa validité
        do{
            $hash = password_hash($pass1, PASSWORD_DEFAULT);
        }while(password_needs_rehash($hash, PASSWORD_DEFAULT) || !(password_verify($pass1, $hash)));

        // Déchargement des données dans la BDD
        $rq_i = "UPDATE users SET Nom=?, Prenom=?, mail=?, pass=? WHERE card_id=?;";
        $stmt2 = $link -> prepare($rq_i);
        $stmt2->bind_param("sssss", $nom, $prenom, $mail, $hash, $id_card);
        $stmt2->execute();
        $stmt2->close();
        http_response_code( 200 );
        echo json_encode( [ 'msg' => '<li>Inscription réussie !</li>' ] );
    }else{
        http_response_code( 406 ); 
        echo json_encode( [ 'msg' => $errors ] );
    }
?>