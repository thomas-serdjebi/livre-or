<?php




?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Accueil</title>
        <link rel="stylesheet" href="css/index.css">
        <link rel="stylesheet" href="css/header.css">
        <link rel="stylesheet" href="css/footer.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Lobster&family=Oleo+Script+Swash+Caps&display=swap" rel="stylesheet">

    </head>

    <body>

        <?php require('header.php') ; ?>

        <main>

            <h1 class="animtitle">Bienvenue chez UrBar,</br>ton Bar.</h1>

            <section>

                

                <p class="intro">Chez UrBar, élabore tes propres cocktails, que tu sois mixologue ou non ! </p>

                <p> Consulte notre <a href="livre-or.php" target="_blank" class="mainliens">Livre d'or</a> pour te faire une idée ! </p>

                <p>Alors, tu souhaites devenir membre et bénéficier d'un accès privilégié au UrBar ?</br>
                    <br>Inscris toi ci dessous !
                </p>   

                <form action="inscription.php" method="get">
                    <button type="submit" class="submitbtn">Inscription</button>
                </form>

                <p> Déjà inscris ? Connecte toi ! </p>

                <form action="connexion.php" method="get">
                    <button type="submit" class="submitbtn">Connexion</button>
                </form>

                

            </section>
                
            
        </main>

        <?php require('footer.php') ; ?>



    </body>





 


  

</html>

