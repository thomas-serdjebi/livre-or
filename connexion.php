<?php

    session_start();

    require('connexiondb.php'); // CONNEXION A LA BDD 

    $afficheform = 1 ;

    

    if(!empty($_POST)) {
        extract($_POST);
        $valid=(boolean)true;  // VALID POUR ENCLENCHER REQUETE

        $login = $_POST['login']; 
        $mdp = $_POST['mdp'];
        

        // VERIF LOGIN ---- 

        if (empty($login)) {

            $err_login = "Veuillez renseigner votre login.";
            $valid = false;
            
        }

        // VERIF MDP ---- 

        if (empty($mdp)) {

            $err_mdp = "Veuillez renseigner votre mot de passe.";
            $valid = false;
        }

        // SI LES DEUX CHAMPS SONT REMPLIS --> VERIF MDP ET PASSWORD DANS BDD

        if ($valid) {

            $connect = mysqli_query($mysqli, "SELECT * FROM utilisateurs WHERE login ='".$login."'  && password = '".md5($mdp)."'");

            $testconnect = mysqli_num_rows($connect);

            if ( $testconnect == 1 ) {

                $_SESSION['login'] = "$login" ;
                $afficheform = 0;
            }

            else {

                $err_connexion = "Le login et/ou le mot de passe est incorrect.";

            }
        }

    }

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Connexion</title>
        <link rel="stylesheet" href="css/connexion.css">
        <link rel="stylesheet" href="css/header.css">
        <link rel="stylesheet" href="css/footer.css">
        <link rel="stylesheet" href="css/forms.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Lobster&family=Oleo+Script+Swash+Caps&display=swap" rel="stylesheet">
        

    </head>

    <body>

        <?php require('header.php') ?>

        <main>

            <section class="content">

                <h1 class="titre">Connexion</h1>

                <!-- FORMULAIRE DE CONNEXION -->


                <?php if ($afficheform == 1)  { ?>

                <form action="connexion.php" method="post" class="styleform">

                    <div class="formerror"><?php if (isset($err_login)) { echo $err_login ;} ?></div>
                    <div><input type="text" class="basicinput" name="login" placeholder="Login"></div>
                    
                    <div class="formerror"><?php if (isset($err_mdp)) { echo $err_mdp ;} ?></div>
                    <div><input type="password" class="basicinput" name="mdp" placeholder="Mot de passe"></div>

                    <div class="formerror"><?php if (isset($err_connexion)) { echo $err_connexion ;} ?></div>
                    <div><input type="submit" class="submitbtn" id="connexion" name="connexion" value="Connexion"><br></div>

                </form>


                <!-- PAS ENCORE INSCRIT ? INSCRIPTION -->

                <div class="intro"> Tu n'as pas de compte ? Inscris toi ci-dessous !</div>

                <!-- BOUTON LIEN VERS PAGE INSCRIPTION -->

                <div><a href="inscription.php"><input type="button" class="submitbtn" value="Inscription"></a></div>

                <?php } ?>

                <!-- SI CONNECTE ON FERME LE FORM ET BOUTON VERS PROFIL / commentaire -->

                <?php if ($afficheform == 0 ) { ?>
                
                <p class="intro"> Tu es connecté ! </p><br>

                <p class="intro"> N'hésite pas à modifier ton <a href="profil.php">profil</a>.<br>

                <p class="intro"> Quand tu auras expérimenté UrBar, n'hésite pas à <a href="commentaire.php">partager</a> ton expérience dans le <a href="livre-or.php">Livre d'or</a><br>



                <?php } ?>

                

            </section>
            
        </main>

        <?php require('footer.php') ?>




    </body>







</html>
