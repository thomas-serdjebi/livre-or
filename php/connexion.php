<?php

    session_start()

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

                <form action="connexion.php" method="post">

                    <div><?php if (isset($err_login)) { echo $err_login ;} ?></div>
                    <div><input type="text" class="basicinput" name="login" placeholder="Login"></div>
                    
                    <div><?php if (isset($err_mdp)) { echo $err_mdp ;} ?></div>
                    <div><input type="password" class="basicinput" name="mdp" placeholder="Mot de passe"></div>

                    <div><?php if (isset($err_connexion)) { echo $err_connexion ;} ?></div>
                    <div><input type="submit" class="submitinput" name="connexion" value="Connexion><br></div>

                </form>

                <!-- PAS ENCORE INSCRIT ? INSCRIPTION -->

                <div> Vous n'avez pas de compte ? Inscrivez-vous ci-dessous ! </div>

                <!-- BOUTON LIEN VERS PAGE INSCRIPTION -->

                <div><a href="inscription.php"><input type="button" class="linkbutton" value="Inscription"></a></div>

                

            </section>
            
        </main>

        <!-- AJOUTER LE FOOTER REQUIRE -->




    </body>





 


  <

</html>
