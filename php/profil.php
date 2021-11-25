<?php

    session_start();

    require('connexiondb.php');


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
                        <input type="button" name="loginform" value="Modifier le login" class="openbutton">
                    </div>

                    <div>
                        <?php if ($openlogin ==1) {?>
                        <form action="profil.php" method="post" class="styleform">
                            <div><input type="text" name="newlogin" placeholder="nouveau login"></div>
                            <div><input type="text" name="confirmlogin" placeholder="confirmez le nouveau login"></div>
                            <br>
                            <div><input type="submit" name="modiflogin" value="Modifier"></div> 
                            <?php } 
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

                    <div>
                        <?php if ($openmdp ==1) {?>
                        <form action="profil.php" method="post" class="styleform">
                            <div><input type="text" name="newmdp" placeholder="Nouveau mot de passe"></div>
                            <div><input type="text" name="confirmmdp" placeholder="Confirmez votre nouveau mot de passe"></div>
                            <br>
                            <div><input type="submit" name="modifmdp" value="Modifier"></div> 
                            <?php } 
                            if (isset($newmdpok)) { echo $newmdpnok ;} 
                            ?>
                        </form>
                    </div>

                </div>

               
            </section>

                

        </section>
        
            
    </main>

        <!-- AJOUTER LE FOOTER REQUIRE -->




    </body>

           







</html>











