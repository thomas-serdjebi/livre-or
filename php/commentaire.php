<?php

    session_start();

    

    require('connexiondb.php');

   

    if (!isset($_SESSION['login'])) {                                                       // SI PAS DUTILISATEUR CONNECTE
        echo "Erreur, vous n'êtes pas connecté.";
        $err_connexion = "Vous devez vous connecter pour accéder à cette page." ;

    } 

    else { echo $_SESSION ['login'];
        
        if ( isset($_POST['commenter'])) {

            $commentaire = $_POST['commentaire'];                                                           // VERIF SI CHAMP VIDE 

            if (empty($commentaire)) {

                echo "Veuillez saisir votre commentaire";
                $err_com = "Veuillez saisir votre commentaire";
            }

            else {

                // REQUETE RECUPERATION ID UTILISATEUR

                $sqlid = mysqli_query($mysqli, "SELECT id FROM utilisateurs WHERE login = '".$_SESSION['login']."'");

                $resultid = mysqli_fetch_assoc($sqlid);

                $id_utilisateur = $resultid['id'] ;

                

                // REQUETE DAJOUT DU COMMENTAIRE

                $sqlcom = mysqli_query($mysqli, "INSERT INTO commentaires(commentaire,id_utilisateur,date) VALUES ('$commentaire','$id_utilisateur',now()");


    
            }
        }

    }



?>


<html>
    <head>
        <meta charset="utf-8">
        <title>Commentaire</title>
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
                        <form action="commentaire.php" method="post" class="styleform">
                            <div><textarea name='commentaire' rows='4' cols='55' placeholder='commentaire'></textarea></div>
                            <div><input type='submit' name='commenter' value='Poster' ></div>
                        </form>  
                    </div>
                </div>
 
            </section>

                

        </main>

        <!-- AJOUTER LE FOOTER REQUIRE -->
        
            
    </body>
</html>











