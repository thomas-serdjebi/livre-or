<!-- HEADER DE L'INDEX -->
<?php



?>

<script>
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunctioncompte() {
    document.getElementById("myDropdowncompte").classList.toggle("show");
}

function myFunctionlivre() {
    document.getElementById("myDropdownlivre").classList.toggle("show");
}
// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {

    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
</script>


<header>

    <div class="hleftbox">

        <div class="hleftboxsup">
            <a href="index.php"><img src="assets/logo.png" alt="logo" class="headerlogo" ></a>
        </div>


    </div>

    <div class="hrightbox">

        <div class="hbuttons">
            <div class="dropdown" id="comptebtn">
                <button onclick="myFunctioncompte()" class="dropbtn" id="compte"></button>
                <div id="myDropdowncompte" class="dropdown-content">

                    <?php if(!isset($_SESSION['login'])) { ?>
                        <a href="inscription.php">Inscription</a>
                        <a href="connexion.php">Connexion</a>
                    <?php } ?>

                    <?php if(isset($_SESSION['login'])) { ?>
                        <a href="profil.php">Profil</a>
                        <a href="deconnexion.php">Déconnexion</a>
                    <?php } ?>

                </div>
            </div>
        </div>
            
        <div class="hbuttons">
            <div class="dropdown" id="bookbtn">
                <button onclick="myFunctionlivre()" class="dropbtn" id="livre"></button>
                <div id="myDropdownlivre" class="dropdown-content">
                    <a href="livre-or.php">Livre d'or</a>
                    <?php if (isset($_SESSION['login'])) { ?>
                        <a href="commentaire.php">Commentaire</a>
                    <?php } ?>
                </div>
            </div>
        </div>

        <?php if(isset($_SESSION['login'])) { ?>

        <div class="boxprofil">
            
            <p class="sessionlog"><?php echo $_SESSION['login'] ?><br>
                Tu es bien connecté.<br><br>
                <a href="deconnexion.php" class="lienlog">Déconnexion</a>
            </p>

        </div>

        <?php ; } ?>


    </div>




</header>

