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
        <title>Livre d'or</title>
        <link rel="stylesheet" href="css/livre-or.css">
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

        <?php require('footer.php');?>
        
            
    </body>
</html>