<?php

    require ('connexiondb.php');

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

                <form>
                    <input type="text" class="basicinput" name="login" placeholder="Login">
                    
                    <input type="password" class="basicinput" name="mdp" placeholder="Mot de passe">

                    <input type="password" class="basicinput" name="confirmmdp" placeholder="Confirmez votre mot de passe">

                    <input type="submit" class="submitinput" name="inscription" value="S'inscrire"><br>

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

