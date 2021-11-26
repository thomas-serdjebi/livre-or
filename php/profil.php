<?php

    session_start();

    

    require('connexiondb.php');

   

    if (!isset($_SESSION['login'])) {                                                       // SI PAS DUTILISATEUR CONNECTE
        echo "Erreur, vous n'êtes pas connecté.";
        $err_connexion = "Vous devez vous connecter pour accéder à cette page." ;

    } 

    else { echo $_SESSION ['login'];}

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
            echo "Veuillez renseigner votre nouveau login.";
            $err_newlogin = "Veuillez renseigner votre nouveau login.";
            $validlogin = false;
        }

        elseif (!preg_match("#^[a-z0-9]+$#" ,$newlogin)) {                                  // NEWLOGIN : SANS MAJ, SANS SPEC, MIN ET CHIFFRES OK

            echo "Le login doit être renseigné uniquement en lettres miniscules ou chiffres, sans caractères spéciaux." ;
            $err_login = "Le login doit être renseigné uniquement en lettres miniscules ou chiffres, sans caractères spéciaux." ;
            $valid = false;

        }        
        
        elseif(strlen($newlogin)>25) {                                                      // NEWLOGIN : MAXIMUM 25 CARACTERES                         
            echo "Le login ne doit pas dépasser 25 caractères." ;          
            $err_login= "Le login est trop long, il dépasse 25 caractères.";
            $valid= false;
        }

        elseif ($newlogin == $_SESSION['login']) {                                          // VERIF SI CEST DEJA LE LOGIN UTILISE 
            echo "Vous utilisez déjà ce login.";
            $err_newlogin = "Vous utilisez déjà ce login";
            $validlogin=false;
        }

        if(empty($confirmlogin)) {                                                          // VERIF SI CONFIRM LOGIN REMPLI
            echo "Veuillez confirmer votre nouveau login";
            $err_confirmlogin = " Veuillez confirmer votre nouveau login";
            $validlogin=false;
        }

        elseif($newlogin != $confirmlogin) {                                                // VERIF SI NEW LOGIN ET CONFIRM LOGIN CORRESPONDENT
            echo "Les nouveaux logins ne correspondent pas.";
            $err_2logins = "Les nouveaux logins ne correspondent pas." ;
            $validlogin = false;
        }

        //------------------------------------------- REQUETE MODIF LOGIN SI PAS DERREURS

        if($validlogin==true) {

            $requestlogin = "UPDATE utilisateurs SET login= '$newlogin' WHERE login = '".$_SESSION['login']."'" ;

            if(mysqli_query($mysqli, $requestlogin)) {
                echo "Le login a bien été modifié." ;
                $newloginok = "Le nouveau login a bien été enregistré.";
                $openlogin = 0;                                                             // FERME LE FORMULAIRE LOGIN SI MODIF OK
            }

            else {
                echo "Le login n'a pas pu être modifié." ;                                  // AFFICHE LERREUR SI BUG
                $err_modiflogin = "Le login n'a pas pu être modifié." ;
            }
        }

    }   
    
    // MODIFICATION DU MDP ---------------------------------------------------------------------------------------------------------------


    $validmdp = (boolean) true ;                                                          // SI TRUE = PAS DERREUR ALORS LANCE LA REQUETE
    $openmdp = 0 ;                                                                        // FORMULAIRE CACHE PAR DEFAUT

    if (isset($_POST['mdpform'])) {                                                       // AFFICHAGE DU FORMULAIRE DU Login

        $openmdp = 1 ;  
    }    

    if (isset($_POST['modifmdp'])) {

        $openmdp = 1 ;                                                                    // GARDE LE FORMULAIRE OUVERT SI ERREURS

        // VARIABLES DU POST

        $actualmdp = md5($_POST['actualmdp']);
        $newmdp = md5($_POST['newmdp']) ;
        $confirmmdp = md5($_POST['confirmmdp']) ;


        //-------------------------------------------------VERIF DES ERREURS DU NEW MDP

        if(empty($actualdmp)) {
            echo "Veuillez renseigner votre mot de passe actuel.";
            $err_actualmdp = "Veuillez renseigner votre mot de passe actuel.";
        }

        $sql = "SELECT count(*) FROM utilisateurs WHERE password = '$actualmdp' && login = '".$_SESSION['login']."'"; // REQUETE VERIF ACTUAL MDP

        $testmdp = mysqli_query($mysqli, $sql);

        $resultmdp = mysqli_num_rows($testmdp);

        if ($resultmdp == 0) {                                                                                            // SI PAS DE RESULTAT => VALID FAUX
            echo "Le mot de passe actuel est incorrect";
            $err_actualmdp = "Le mot de passe actuel est incorrect";
            $validmdp = false;
        }


        
        if(empty($newmdp)) {                                                              // VERIF SI NEW MDP REMPLI
            echo "Veuillez renseigner votre nouveau mot de passe.";
            $err_newmdp = "Veuillez renseigner votre nouveau mot de passe.";
            $validmdp = false;
        }

        //                                                                                 // test ENTRE 8 ET 20 CARACTERES au moins 1 majuscule/miniscule/chiffres/caracspec

        elseif(!preg_match('/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{8,20}$/',$newmdp)) {
            $err_mdp = "Le nouveau mot de passe ne respecte pas les condtions.";
            $validmdp = false;

        }
        


        if(empty($confirmmdp)) {                                                               // TEST CONFIRM MDP si vide

            $err_confirmmdp = "Veuillez confirmer votre mot de passe";
            $validmdp = false;

        }

        elseif(isset($mdp) && isset($confirmmdp)) {                                                 // TESTS SI MDP ET CONFIRM MDP PAREILS

            if ($mdp != $confirmmdp) {

                $err_confirm ="Les mots de passe ne correspondent pas.";
                $validmdp = false;

            }


        }



        //------------------------------------------- REQUETE MODIF MDP SI PAS DERREURS

        if($validmdp==true) {

            $requestmdp = "UPDATE utilisateurs SET password= '$newmdp' WHERE login = '".$_SESSION['login']."'" ;

            if(mysqli_query($mysqli, $requestmdp)) {
                echo "Le login a bien été modifié." ;
                $newloginok = "Le nouveau login a bien été enregistré.";
                $openlogin = 0;                                                             // FERME LE FORMULAIRE LOGIN SI MODIF OK
            }

            else {
                echo "Le login n'a pas pu être modifié." ;                                  // AFFICHE LERREUR SI BUG
                $err_modifmdp = "Le login n'a pas pu être modifié." ;
            }
        }

    }   

    


?>


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

                <!-- TEXTE AVANT INFOS PROFIL -->

            </section>

            <section class="formsbox">

                <!-- FORMULAIRE DE MODIFICATION LOGIN -->
                
                <div class="boxmodif">
                    <div>
                        <form action="profil.php" method="post" class="styleform">
                            <div><input type="submit" name="loginform" value="Modifier le login" class="openbutton"></div>
                        </form>
                        <?php if ($openlogin == 1) { ?>
                            <form action ='profil.php' method='post' class='styleform'> 
                                <div><input type='text' name='newlogin' placeholder='Nouveau login'></div>
                                <div><input type='text' name='confirmlogin' placeholder='Confirmez le nouveau login'></div><br>
                                <div><input type='submit' name='modiflogin' value='Modifier'></div>
                            </form>
                        <?php ;}?>
                        <?php if (isset($newloginok)) { echo $newloginok ;} ?>
                        
                    </div>
                </div>

                <!-- FORMULAIRE DE MODIFICATION MDP -->

                <div class="boxmodif">
                    <div>
                        <form action="profil.php" method="post" class="styleform">
                            <div><input type="submit" name="mdpform" value="Modifier le mot de passe" class="openbutton"></div>
                        </form>
                        <?php if ($openmdp == 1) { ?>
                            <form action ='profil.php' method='post' class='styleform'>
                                <div><input type='password' name='actualmdp' placeholder='Mot de passe actuel'></div>
                                <div><input type='password' name='newmdp' placeholder='Nouveau mot de passe'></div>
                                <div><input type='password' name='confirmmdp' placeholder='Confirmez le nouveau mot de passe'></div><br>
                                <div><input type='submit' name='modifmdp' value='Modifier'></div>
                            </form>
                        <?php ;}?>
                        <?php if (isset($newmdpok)) { echo $newmdpnok ;} ?>
                        
                    </div>
                </div>
 
            </section>

                

        </main>

        <!-- AJOUTER LE FOOTER REQUIRE -->
        
            
    </body>
</html>











