<?php

    require ('connexiondb.php');

    if (!empty($_POST)) {
        extract($_POST);
        $valid = (boolean) true;

        $login = $_POST['login'];
        $mdp= $_POST['mdp'];
        $confirmmdp = $_POST['confirmmdp'];


        if (isset($_POST['inscription'])) {  // SI CLIQUE SUR INSCRIPTION ALORS...

            // TESTS DU LOGIN --------------------------------------------------------------------------------------------------------------------

            if(empty($login)) {                                                         // LOGIN : CHAMP VIDE ?

                echo "Veuillez renseigner votre login";
                $err_login = "Veuillez renseigner votre login";
                $valid = false;
            }

            elseif (!preg_match("#^[a-z0-9]+$#" ,$login)) {                               // LOGIN : SANS MAJ, SANS SPEC, MIN ET CHIFFRES OK

                echo "Le login doit être renseigné uniquement en lettres miniscules ou chiffres, sans caractères spéciaux." ;
                $err_login = "Le login doit être renseigné uniquement en lettres miniscules ou chiffres, sans caractères spéciaux." ;
                $valid = false;

            }        
            
            elseif(strlen($login)>25) {                                                 // LOGIN : MAXIMUM 25 CARACTERES                         
                echo "Le login ne doit pas dépasser 25 caractères." ;          
                $err_login= "Le login est trop long, il dépasse 25 caractères.";
                $valid= false;
            }

            $testlogin = mysqli_query($mysqli, "SELECT * FROM utilisateurs WHERE login = '".$login."'") ; // LOGIN : DEJA UTILISE ?

            $resultlogin = mysqli_num_rows($testlogin) ;

            if ($resultlogin == 1) {                                                                                         

                echo "Ce login est déjà utilisé.";
                $err_login = "Ce login est déjà utilisé.";
                $valid = false;

            }

            // TESTS MOT DE PASSE  -----------------------------------------------------------------------------------------------------------------

            if(empty($mdp)) {                                                                //  MDP TEST SI VIDE

                echo "Veuillez renseigner votre mot de passe";
                $err_password = "Veuillez renseigner votre mot de passe";
                $valid=false;
            }


            //                                                  MDP : test ENTRE 8 ET 20 CARACTERES au moins 1 majuscule/miniscule/chiffres/caracspec

            elseif(!preg_match('/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{8,20}$/',$mdp)) {

                echo "Le mot de passe ne respecte pas les conditions";
                $err_mdp = "Le mot de passe ne respecte pas les condtions.";
                $valid = false;

            }


            if(empty($confirmmdp)) {                                                               // TEST CONFIRM MDP si vide

                echo "Veuillez confirmer votre mot de passe";
                $err_confirmmdp = "Veuillez confirmer votre mot de passe";
                $valid = false;

            }

            elseif(isset($mdp) && isset($confirmmdp)) {                                                 // TESTS SI MDP ET CONFIRM MDP PAREILS

                if ($mdp != $confirmmdp) {

                    echo "Les mots de passes ne correspondent pas.";
                    $err_confirm ="Les mots de passe ne correspondent pas.";
                    $valid = false;

                }


            }

            // SI REGLES OK ALORS INSCRIPTION -----------------------------------------------------------------------------------------------------------

            if ($valid) {

                $inscription = "INSERT INTO utilisateurs (login,password) VALUES ('$login','".md5($mdp)."')"; //REQUETE CREATION UTILISATEURS AVEC MDP HACH

                if (mysqli_query($mysqli, $inscription)) {

                    echo "Vous êtes inscrit(e).";
                    $inscriptionok = "Vous êtes inscrits.";

                    //RAJOUTER LE HEADER LOCATION VERS CONNEXION
                }

            }

        }

    }

    

?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Inscription</title>
        <!-- LINK LE CSS A FAIRE  -->

    </head>

    <body>

        <!-- REQUIRE LE HEADER QUAND CREE -->

        <main>

            <section> 

                <!-- TEXTE AVANT FORMULAIRE -->

            </section>

            <section>

                <!-- FORMULAIRE DINSCRIPTION -->

                <form action="inscription.php" method="post">

                    <div><?php if (isset($err_login)) { echo $err_login} ;?></div>
                    <div><input type="text" class="basicinput" name="login" placeholder="Login"></div>
                    
                    <div><?php if (isset($err_mdp)) { echo $err_mdp} ;?></div>
                    <div><input type="password" class="basicinput" name="mdp" placeholder="Mot de passe"></div>

                    <div><?php if (isset($err_confirmmmdp)) { echo $err_confirmmdp} ;?></div>
                    <div><input type="password" class="basicinput" name="confirmmdp" placeholder="Confirmez votre mot de passe"></div>

                    <div><?php if (isset($err_confirm)) { echo $err_confirm} ;?></div>
                    <div><input type="submit" class="submitinput" name="inscription" value="S'inscrire"><br></div>

                </form>

                <!-- DEJA INSCRIT ? CONNEXION -->

                <div> Déjà inscrit ? Connectez vous ci-dessous ! </div>

                <!-- BOUTON LIEN VERS PAGE CONNEXION -->

                <div><a href="connexion.php"><input type="button" class="linkbutton" value="Connexion"></a></div>

                

            </section>
            
        </main>

        <!-- AJOUTER LE FOOTER REQUIRE -->




    </body>





 


  <

</html>

