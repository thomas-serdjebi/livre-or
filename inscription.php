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

            $testlogin = mysqli_query($mysqli, "SELECT * FROM utilisateurs WHERE login = '".$login."'") ; // LOGIN : DEJA UTILISE ?

            $resultlogin = mysqli_num_rows($testlogin) ; // REQUETE SI LOGIN UTILISE

            if(empty($login)) {                                                         // LOGIN : CHAMP VIDE ?

                
                $err_login = "Veuillez renseigner votre login.";
                $valid = false;
            }

            elseif (!preg_match("#^[a-z0-9]+$#" ,$login)) {                               // LOGIN : SANS MAJ, SANS SPEC, MIN ET CHIFFRES OK

                
                $err_login = "Le login doit être renseigné uniquement en lettres miniscules ou chiffres, sans caractères spéciaux." ;
                $valid = false;

            }        
            
            elseif(strlen($login)>25) {                                                 // LOGIN : MAXIMUM 25 CARACTERES                         
                      
                $err_login= "Le login est trop long, il dépasse 25 caractères.";
                $valid= false;
            }



            elseif ($resultlogin == 1) {                                                                                         

                $err_login = "Ce login est déjà utilisé.";
                $valid = false;

            }

            // TESTS MOT DE PASSE  -----------------------------------------------------------------------------------------------------------------

            if(empty($mdp)) {                                                                //  MDP TEST SI VIDE

                $err_mdp = "Veuillez renseigner votre mot de passe.";
                $valid=false;
            }


            //                                                  MDP : test ENTRE 8 ET 20 CARACTERES au moins 1 majuscule/miniscule/chiffres/caracspec

            elseif(!preg_match('/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{8,20}$/',$mdp)) {
                $err_mdp = "Le mot de passe ne respecte pas les condtions.";
                $valid = false;

            }


            if(empty($confirmmdp)) {                                                               // TEST CONFIRM MDP si vide

                $err_confirmmdp = "Veuillez confirmer votre mot de passe.";
                $valid = false;

            }

            elseif(isset($mdp) && isset($confirmmdp)) {                                                 // TESTS SI MDP ET CONFIRM MDP PAREILS

                if ($mdp != $confirmmdp) {

                    $err_confirm ="Les mots de passe ne correspondent pas.";
                    $valid = false;

                }


            }

            // SI REGLES OK ALORS INSCRIPTION -----------------------------------------------------------------------------------------------------------

            if ($valid) {

                $inscription = "INSERT INTO utilisateurs (login,password) VALUES ('$login','".md5($mdp)."')"; //REQUETE CREATION UTILISATEURS AVEC MDP HACH

                if (mysqli_query($mysqli, $inscription)) {

                    
                    header('Location: connexion.php');
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
        <link rel="stylesheet" href="css/inscription.css">
        <link rel="stylesheet" href="css/header.css">
        <link rel="stylesheet" href="css/footer.css">
        <link rel="stylesheet" href="css/forms.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Lobster&family=Oleo+Script+Swash+Caps&display=swap" rel="stylesheet">

        

    </head>

    <body>

        <?php require('header.php');?>

        <main>

            

            <section class="content">
                
                <div><h1 class="titre">Inscription</h1></div>

                <div> 

                    <p class="intro">
                        Envie de shaker (les cokctails) avec nous ?<br>
                        Rempli le formulaire !

                    </p>

                </div>

                <div class="formplace">

                    <!-- FORMULAIRE DINSCRIPTION -->

                    <form action="inscription.php" method="post" class="styleform">

                        <?php if(isset($err_login)) { echo "<div class='formerror'> $err_login </div>";} ?>
                        <div><input type="text" class="basicinput" name="login" placeholder="Login"></div>
                        
                        <?php if(isset($err_mdp)) { echo "<div class='formerror'> $err_mdp </div>";} ?>
                        <div><input type="password" class="basicinput" name="mdp" placeholder="Mot de passe"></div>

                        <?php if(isset($err_confirmmdp)) { echo "<div class='formerror'> $err_confirmmdp </div>";} ?>
                        <?php if(isset($err_confirm)) { echo "<div class='formerror'> $err_confirm </div>";} ?>
                        <div><input type="password" class="basicinput" name="confirmmdp" placeholder="Confirmez votre mot de passe"></div>

                        
                        <div><input type="submit" class="submitbtn" name="inscription" value="S'inscrire"><br></div>

                    </form>

                    <div class="boxregles">
                        <ul class="regles">
                            <li>Login : uniquement en lettres miniscules ou chiffres, sans caractères spéciaux, 25 caractères maximum.</li>
                            <li>Mot de passe : entre 8 et 20 caractères, avec au moins 1 majuscule, 1 minuscule, 1 chiffre, 1 caractère spécial. </li>
                        </ul>
                    </div>  




                    <!-- DEJA INSCRIT ? CONNEXION -->

                    <div class="intro"> Déjà inscrit ? Connectez vous ci-dessous ! </div>

                    <!-- BOUTON LIEN VERS PAGE CONNEXION -->

                    <div><a href="connexion.php"><input type="button" class="submitbtn" value="Connexion"></a></div>

                    

                </div>

            </section>
            
        </main>

        <?php require('footer.php');?>




    </body>




</html>

