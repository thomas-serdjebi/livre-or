<?php

    session_start();

    require('connexiondb.php'); // CONNEXION A LA BDD 

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
                $connexionok ="Vous êtes connecté." ;
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
        <!-- LINK LE CSS A FAIRE  -->

    </head>

    <body>

        <!-- REQUIRE LE HEADER QUAND CREE -->

        <main>

            <section> 

                <!-- TEXTE AVANT FORMULAIRE -->

            </section>

            <section>

                <!-- FORMULAIRE DE CONNEXION -->

                <div><?php if (isset($connexionok)) { echo $connexionok ;} ?></div>

                <form action="connexion.php" method="post">

                    <div><?php if (isset($err_login)) { echo $err_login ;} ?></div>
                    <div><input type="text" class="basicinput" name="login" placeholder="Login"></div>
                    
                    <div><?php if (isset($err_mdp)) { echo $err_mdp ;} ?></div>
                    <div><input type="password" class="basicinput" name="mdp" placeholder="Mot de passe"></div>

                    <div><?php if (isset($err_connexion)) { echo $err_connexion ;} ?></div>
                    <div><input type="submit" class="submitinput" name="connexion" value="Connexion"><br></div>

                </form>

                <!-- PAS ENCORE INSCRIT ? INSCRIPTION -->

                <div> Vous n'avez pas de compte ? Inscrivez-vous ci-dessous ! </div>

                <!-- BOUTON LIEN VERS PAGE INSCRIPTION -->

                <div><a href="inscription.php"><input type="button" class="linkbutton" value="Inscription"></a></div>

                

            </section>
            
        </main>

        <!-- AJOUTER LE FOOTER REQUIRE -->




    </body>







</html>
