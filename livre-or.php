<?php

    require('connexiondb.php');

    $sql = mysqli_query($mysqli, 
    "SELECT commentaire, login, date 
    FROM utilisateurs
    INNER JOIN commentaires ON utilisateurs.id = commentaires.id_utilisateur ORDER By date DESC");

    $result = mysqli_fetch_all($sql);


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

                <!-- TEXTE AVANT livre DOR -->

            </section>

            <section>
                <table>
                    <?php foreach($result as $value) {
                        $date = $value[2];
                        $login = $value[1];
                        $commentaire = $value[0];
                        echo "<tr>
                        <td> Posté le '".$date."'<br> par '".$login."' </td>
                        <td> '".$commentaire."'</td>
                        </tr>" ; }
                    ?>

                </table>

            </section>



                

        </main>

        <!-- AJOUTER LE FOOTER REQUIRE -->
        
            
    </body>
</html>