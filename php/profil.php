<?php

    session_start();

    require('connexiondb.php');

   

    if (!isset($_SESSION['login'])) { // SI PAS DUTILISATEUR CONNECTE
        echo "Erreur, vous n'êtes pas connecté.";
        $err_connexion = "Vous devez vous connecter pour accéder à cette page." ;

    }

    require ('connexiondb.php'); // CONNEXION A LA BDD

    // VARIABLES DOUVERTURES ET DE VALIDATION DES MODIF

    $validlogin = (boolean) true ;
    $openlogin = 0 ;
    $validmdp = (boolean) true ;
    $openmdp = (boolean) false ;

    //$confirmmdp = $_POST['confirmmdp'] ;     // A RAJOUTER APRES LE IF ISSET POST MODIF MDP
    // $newmdp = $_POST['newmdp'] ;            // A RAJOUTER APRES LE IF ISSET POST MODIF MDP


    // PARTIE LOGIN ----------------------------------------------------------------------------------------------------

    if (isset($_POST['loginform'])) {

        $openlogin = 1 ;                                                         // AFFICHAGE DU FORMULAIRE DU Login

        if (isset($_POST['modiflogin'])) {

            // VARIABLES DU POST

            $newlogin = $_POST['newlogin'] ;
            $confirmlogin = $_POST['confirmlogin'] ;
    

            //-------------------------------------------------VERIF DES ERREURS DU NEW LOGIN
            
            if(empty($newlogin)) {                                                      // VERIF SI NEW LOGIN REMPLI
                echo "Veuillez renseigner votre nouveau login.";
                $err_newlogin = "Veuillez renseigner votre nouveau login.";
                $validlogin = false;
            }

            elseif ($newlogin = $_SESSION['login']) {                                   // VERIF SI CEST DEJA LE LOGIN UTILISE 
                echo "Vous utilisez déjà ce login.";
                $err_newlogin = "Vous utilisez déjà ce login";
                $validlogin=false;
            }

            if(empty($confirmlogin)) {                                                      // VERIF SI CONFIRM LOGIN REMPLI
                echo "Veuillez confirmer votre nouveau login";
                $err_confirmlogin = " Veuillez confirmer votre nouveau login";
                $validlogin=false;
            }

            //------------------------------------------- REQUETE MODIF LOGIN SI PAS DERREURS

            if($validlogin==true) {

                $requestlogin = mysqli_query($mysqli, "UPDATE utilisateurs SET login= '".$login."'");

                if(mysqli_query($requestlogin)) {
                    echo "Le login a bien été modifié." ;
                    $newloginok = "Le nouveau login a bien été enregistré.";
                }

                else {
                    echo "Le login n'a pas pu être modifié." ;
                    $err_modiflogin = "Le login n'a pas pu être modifié." ;
                }




            }


        }
    }
   
    





    // MODIFICATION DU LOGIN ---------------------------------------------------------------------------------------------------------------

    







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

                <!-- TEXTE AVANT INFOS PROFIL -->

            </section>

            <section class="formsbox">

                <!-- FORMULAIRE DE MODIFICATION LOGIN -->
                
                <div class="boxmodif">
                    <div>
                        <form action="profil.php" method="post" class="styleform">
                            <div><input type="submit" name="loginform" value="Modifier le login" class="openbutton"></div>
                            <?php if ($openlogin == 1) {  
                            echo "<div><input type='text' name='newlogin' placeholder='nouveau login'></div>" ;
                            echo "<div><input type='text' name='confirmlogin' placeholder='confirmez le nouveau login'></div><br>" ;
                            echo "<div><input type='submit' name='modiflogin' value='Modifier'></div>"  ;
                            if (isset($newloginok)) { echo $newloginok ;} 
                            ?>
                        </form>
                    </div>
                </div>

                <!-- FORMULAIRE DE MODIFICATION MDP -->

                <div class="boxmodif">
                    <div>
                        <input type="button" name="mdpform" class="openbutton" value="Modifier le mot de passe">
                    </div>

                    

               
            </section>

                

        </main>

        <!-- AJOUTER LE FOOTER REQUIRE -->
        
            
    </body>

        




    

           







</html>











