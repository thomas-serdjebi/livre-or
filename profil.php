<?php

    session_start();

    

    require('connexiondb.php');

   

    if (!isset($_SESSION['login'])) {                                                       // SI PAS DUTILISATEUR CONNECTE
        $err_connexion = "Vous devez vous connecter pour accéder à cette page." ;
        header('Location: connexion.php');

    } 

    else { 

        require ('connexiondb.php'); // CONNEXION A LA BDD


        // PARTIE LOGIN ----------------------------------------------------------------------------------------------------

        $validlogin = (boolean) true ;                                                          // SI TRUE = PAS DERREUR ALORS LANCE LA REQUETE
        $openlogin = 0 ;                                                                        // FORMULAIRE CACHE PAR DEFAUT

        if (isset($_POST['loginform'])) {                                                       // AFFICHAGE DU FORMULAIRE DU Login

            $openlogin = 1 ;  
        }    

        if (isset($_POST['modiflogin'])) {

            $openlogin = 1 ;                                                                    // GARDE LE FORMULAIRE OUVERT SI ERREURS

            // VARIABLES DU POST

            $newlogin = $_POST['newlogin'] ;
            $confirmlogin = $_POST['confirmlogin'] ;


            //-------------------------------------------------VERIF DES ERREURS DU NEW LOGIN
            
            if(empty($newlogin)) {                                                              // VERIF SI NEW LOGIN REMPLI

                $err_newlogin = "Veuillez renseigner votre nouveau login.";
                $validlogin = false;
            }

            elseif (!preg_match("#^[a-z0-9]+$#" ,$newlogin)) {                                  // NEWLOGIN : SANS MAJ, SANS SPEC, MIN ET CHIFFRES OK

                $err_newlogin = "Le login doit être renseigné uniquement en lettres miniscules ou chiffres, sans caractères spéciaux ou accents." ;
                $valid = false;

            }        
            
            elseif(strlen($newlogin)>25) {                                                      // NEWLOGIN : MAXIMUM 25 CARACTERES                         
                          
                $err_newlogin= "Le login est trop long, il dépasse 25 caractères.";
                $valid= false;
            }

            elseif ($newlogin == $_SESSION['login']) {                                          // VERIF SI CEST DEJA LE LOGIN UTILISE 
               
                $err_newlogin = "Vous utilisez déjà ce login";
                $validlogin=false;
            }

            if(empty($confirmlogin)) {                                                          // VERIF SI CONFIRM LOGIN REMPLI
               
                $err_confirmlogin = " Veuillez confirmer votre nouveau login";
                $validlogin=false;
            }

            elseif($newlogin != $confirmlogin) {                                                // VERIF SI NEW LOGIN ET CONFIRM LOGIN CORRESPONDENT
                
                $err_2logins = "Les nouveaux logins ne correspondent pas." ;
                $validlogin = false;
            }

            //------------------------------------------- REQUETE MODIF LOGIN SI PAS DERREURS

            if($validlogin==true) {

                $requestlogin = "UPDATE utilisateurs SET login= '$newlogin' WHERE login = '".$_SESSION['login']."'" ;

                if(mysqli_query($mysqli, $requestlogin)) {
                  
                    $newloginok = "Le nouveau login a bien été enregistré.";
                    $openlogin = 0;                                          // FERME LE FORMULAIRE LOGIN SI MODIF OK
                    $_SESSION['login'] = $newlogin;     
                                                                   
                    
                }

                else {                                  // AFFICHE LERREUR SI BUG
                    $err_modiflogin = "Le login n'a pas pu être modifié." ;
                }
            }

        }   
        
        // PARTIE MDP  ---------------------------------------------------------------------------------------------------------------


        $validmdp = (boolean) true ;                                                          // SI TRUE = PAS DERREUR ALORS LANCE LA REQUETE
        $openmdp = 0 ;                                                                        // FORMULAIRE CACHE PAR DEFAUT

        if (isset($_POST['mdpform'])) {                                                       // AFFICHAGE DU FORMULAIRE DU Login

            $openmdp = 1 ;  
        }    

        if (isset($_POST['modifmdp'])) {


            $openmdp = 1 ;                                                                    // GARDE LE FORMULAIRE OUVERT SI ERREURS

            // VARIABLES DU POST

            $actualmdp = ($_POST['actualmdp']);
            $newmdp = ($_POST['newmdp']) ;
            $confirmmdp = ($_POST['confirmmdp']) ;



            //-------------------------------------------------VERIF DES ERREURS MDP

            $sql = "SELECT * FROM utilisateurs WHERE password = '".md5($actualmdp)."' && login = '".$_SESSION['login']."'"; // REQUETE VERIF ACTUAL MDP

            $testmdp = mysqli_query($mysqli, $sql);

            $resultmdp = mysqli_num_rows($testmdp);

            if(empty($actualmdp)) {                                                                                     //VERIF SI ACTUEL MDP REMPLI
                $err_actualmdp = "Veuillez renseigner votre mot de passe actuel.";
                $validmdp = false;
            }



            elseif ($resultmdp == 0) {                                                                                            // SI PAS DE RESULTAT => VALID FAUX
                $err_actualmdp = "Le mot de passe actuel est incorrect.";
                $validmdp = false;
            }


            
            if(empty($newmdp)) {                                                              // VERIF SI NEW MDP REMPLI
                $err_newmdp = "Veuillez renseigner votre nouveau mot de passe.";
                $validmdp = false;
            }

            //                                                                                 // test ENTRE 8 ET 20 CARACTERES au moins 1 majuscule/miniscule/chiffres/caracspec

            elseif(!preg_match('/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{8,20}$/', $newmdp)) {
                $err_newmdp = "Le nouveau mot de passe ne respecte pas les conditions.*";
                $validmdp = false;

            }

            elseif(empty($confirmmdp)) {                                                               // TEST CONFIRM MDP si vide

                $err_confirmmdp = "Veuillez confirmer votre mot de passe";
                $validmdp = false;

            }
            

            elseif($newmdp != $confirmmdp) {     
                // TESTS SI MDP ET CONFIRM MDP PAREILS
                $err_confirmmdp ="Les mots de passe ne correspondent pas.";
                $validmdp = false;



            }



            //------------------------------------------- REQUETE MODIF MDP SI PAS DERREURS

            if($validmdp) {

                $requestmdp = "UPDATE utilisateurs SET password= '".md5($newmdp)."' WHERE login = '".$_SESSION['login']."'" ;

                if(mysqli_query($mysqli, $requestmdp)) {
                    $newmdpok = "Le mot de passe a bien été modifié";
                    
                    $openmdp = 0;                                                             // FERME LE FORMULAIRE MDP SI MODIF OK
                }

                else {                               // AFFICHE LERREUR SI BUG
                    $err_modifmdp = "Le login n'a pas pu être modifié." ;
                }
            }

        }
    }   

    


?>


<html>
    <head>
        <meta charset="utf-8">
        <title>Profil</title>
        <link rel="stylesheet" href="css/profil.css">
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

                <h1 class="titre"><?php if(isset($_SESSION['login'])) echo $_SESSION['login'] ?></h1>
                <p class="intro">Bienvenue sur ton profil UrBar</p>

                <!-- FORMULAIRE DE MODIFICATION LOGIN -->
                
                <div class="boxmodif">
                    <div id="loginstyle">

                        <form action="profil.php" method="post" class="styleform">
                            <div><input type="submit" name="loginform" value="Modifier le login" id="openlogin"></div>
                        </form>

                        <?php if ($openlogin == 1) { ?>

                            <form action ='profil.php' method='post' class='styleform'> 

                                <?php if(isset($err_newlogin)) { echo "<div class='formerror'> $err_newlogin </div>";} ?>
                                <div><input type='text' name='newlogin' placeholder='Nouveau login'></div>

                                <?php if(isset($err_confirmlogin)) { echo "<div class='formerror'> $err_confirmlogin </div>";} ?>
                                <div><input type='text' name='confirmlogin' placeholder='Confirmez le nouveau login'></div><br>

                                <?php if(isset($err_2logins)) { echo "<div class='formerror'> $err_2logins </div>";} ?>
                                <?php if(isset($err_modiflogin)) { echo "<div class='formerror'> $err_modiflogin </div>";} ?>

                                <div><input type='submit' name='modiflogin' value='Modifier'></div>

                                <div class="reglesmodif">Login : uniquement en lettres miniscules ou chiffres, sans caractères spéciaux, 25 caractères maximum.</div>
                            </form>

                        <?php ;}?>

                        <p class="intro"><?php if (isset($newloginok)) { echo $newloginok ;} ?></p>
                        
                    </div>
                

                    <!-- FORMULAIRE DE MODIFICATION MDP -->


                    <div id="mdpstyle">

                        <form action="profil.php" method="post" class="styleform">
                            <div><input type="submit" name="mdpform" value="Modifier le mot de passe" id="openmdp"></div>
                        </form>

                        <?php if ($openmdp == 1) { ?>

                            <form action ='profil.php' method='post' class='styleform' id="passformstyle">

                                <?php if(isset($err_actualmdp)) { echo "<div class='formerror'> $err_actualmdp </div>";} ?>
                                <div><input type='password' name='actualmdp' placeholder='Mot de passe actuel'></div>

                                <?php if(isset($err_newmdp)) { echo "<div class='formerror'> $err_newmdp </div>";} ?>
                                <div><input type='password' name='newmdp' placeholder='Nouveau mot de passe'></div>

                                <?php if(isset($err_confirmmdp)) { echo "<div class='formerror'> $err_confirmmdp </div>";} ?>
                                <div><input type='password' name='confirmmdp' placeholder='Confirmez le nouveau mot de passe'></div><br>

                                <?php if(isset($err_modifmdp)) { echo "<div class='formerror'> $err_modifmdp </div>";} ?>
                                <div><input type='submit' name='modifmdp' value='Modifier' id="butmdp"></div>

                                <div class="reglesmodif" id="mdprules">Mot de passe : entre 8 et 20 caractères, avec au moins 1 majuscule, 1 minuscule, 1 chiffre, 1 caractère spécial.</div>

                            </form>

                        <?php ;}?>

                        <p class="intro"><?php if (isset($newmdpok)) { echo $newmdpok ;} ?></p>
                        
                    </div>
                </div>
 
            </section>

                

        </main>

        <?php require('footer.php') ?>
        
            
    </body>
</html>











