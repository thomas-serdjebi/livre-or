<?php

    session_start();

    

    require('connexiondb.php');

   

    if (!isset($_SESSION['login'])) {                                                       // SI PAS DUTILISATEUR CONNECTE
        $err_connexion = "Vous devez vous connecter pour accéder à cette page." ;

    } 

    else { 
        
        if ( isset($_POST['commenter'])) {

            $commentaire = $_POST['commentaire'];                                                           // VERIF SI CHAMP VIDE 

            if (empty($commentaire)) {

                $err_com = "Veuillez saisir votre commentaire";
            }

            else {

                // REQUETE RECUPERATION ID UTILISATEUR

                $sqlid = mysqli_query($mysqli, "SELECT id FROM utilisateurs WHERE login = '".$_SESSION['login']."'");

                $resultid = mysqli_fetch_assoc($sqlid);

                $id_utilisateur = $resultid['id'] ;

                

                // REQUETE DAJOUT DU COMMENTAIRE

                $com = mysqli_query($mysqli, "INSERT INTO commentaires (commentaire, id_utilisateur, date) VALUES ('".$commentaire."','".$id_utilisateur."',now())");


                

                


    
            }
        }

    }



?>


<html>
    <head>
        <meta charset="utf-8">
        <title>Commentaire</title>
        <link rel="stylesheet" href="css/commentaire.css">
        <link rel="stylesheet" href="css/header.css">
        <link rel="stylesheet" href="css/footer.css">
        <link rel="stylesheet" href="css/forms.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Lobster&family=Oleo+Script+Swash+Caps&display=swap" rel="stylesheet">


    </head>

    <body>

        <?php require('header.php')?>

        <main>
            <section class="content">

                
                <?php if(!isset($_SESSION['login'])) { echo "
                    <div class='erreur'>$err_connexion<br><br>


                    
                        <form action='inscription.php' method='get'>
                            <button type='submit' class='submitbtn'>Inscription</button>
                        </form>
                    

                    
                        <form action='connexion.php' method='get'>
                            <button type='submit' class='submitbtn'>Connexion</button>
                        </form>
                    </div>"; }
                ?>


                
                <?php if(isset($_SESSION['login'])) { echo"
                <h1 class='titre' '".$_SESSION['login']."',</h1>

                <div>
                    <p class='intro'>N'hésite pas à partager de ton expérience chez UrBar !</br>
                    Ecris et poste ton témoignage dans le formulaire ci-dessous !</br>
                    Il sera publié dans notre livre d'or !
                    </p>
                </div>
                
                <div class='boxmodif'>
                    <div>
                        <form action='commentaire.php' method='post' class='styleform'>
                            <div><textarea name='commentaire' rows='4' cols='55' placeholder='Commentaire'></textarea></div>
                            <div><input type='submit' name='commenter' value='Poster' ></div>
                        </form>  
                    </div>
                </div>

                ";} ?>
                
                
 
            </section>


                

        </main>

        <?php require('footer.php')?>
        
            
    </body>
</html>











